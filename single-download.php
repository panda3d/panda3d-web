<?php
/**
 * The template for displaying single downloads.
 *
 * @package Panda3D
 */

// This array contains data for all supported OS downloads
$os_data = [
    // 'ID'   => ['name',            'icon-class',     'regex']
    'windows' => ['Windows',         'fab fa-windows', '/win16|win95|win98|windows/i'],
    'macos'   => ['macOS',           'fab fa-apple',   '/macintosh|mac os x|mac_powerpc/i'],
    'ubuntu'  => ['Ubuntu',          'fab fa-ubuntu',  '/ubuntu/i'],
    'debian'  => ['Debian',          'fas fa-hdd',     '/debian/i'],
    'fedora'  => ['Fedora',          'fab fa-fedora',  '/fedora/i'],
    'source'  => ['Source Code',     'fas fa-code',    '/freebsd/i'],
    'sample'  => ['Sample Programs', 'fas fa-dice-d6',  null],
    'other'   => ['Miscellaneous',   'fas fa-download', null],
];
$user_agent = $_SERVER["HTTP_USER_AGENT"];

function getOSIdentifier() {
    global $os_data;
    global $user_agent;

    // Attempt to get OS ID from the user agent string
    $os_identifier = 'windows';
    foreach ($os_data as $id => $array) {
        $regex = $array[2];
        if (!is_null($regex) && preg_match($regex, $user_agent)) {
            $os_identifier = $id;
        }
    }
    return $os_identifier;
}

// ACF field which contains all OS downloads
$download_array = get_field('downloads');
$latest_category = get_the_terms(get_the_ID(), 'download_category')[0];

// Latest download to compare with
$latest_download = wp_get_recent_posts(array(
	'numberposts' => 1,
    'post_type' => 'download',
    'post_status' => 'publish',
    'tax_query'   => array(
        array(
            'taxonomy' => 'download_category',
            'field'    => 'slug',
            'terms'    => $latest_category->slug,
        )
    )
))[0];

$latest_id = $latest_download['ID'];
$is_latest = ($latest_id === get_the_ID());

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php include(locate_template('template-parts/downloads/download-header.php')); ?>

                <div class="single-download__content">

                    <?php if(get_field('pip_supported')) { ?>
                        <div class="block block--info">
                            <div class="block__icon">
                                <i class="fab fa-python"></i>
                            </div>
                            <div class="block__content">
                                <p>Already a Python user? You can install this version of Panda3D with pip!</p>
                                <pre>pip install panda3d==<?php the_field('version_number'); ?></pre>
                            </div>
                        </div>
                    <?php } ?>

                    <h1>Other Downloads</h1>
                    <div class="single-download__others block">

                        <?php
                        // Cycle through OS data to list downloads for all systems
                        if(have_rows('downloads')) {
                            while(have_rows('downloads')): the_row();
                                foreach($os_data as $os_id => $os_array) {
                                    $os_field = get_sub_field($os_id);
                                    if(!empty($os_field)) {
                                        $os_name = $os_array[0];
                                        $os_icon = $os_array[1];
                                        ?>
                                        <div>
                                            <h3><i class="<?php echo $os_icon; ?>"></i>&nbsp;&nbsp;<?php echo $os_name; ?></h3>
                                            <ul>
                                            <?php foreach($os_field as $os_download) { ?>
                                                <li>
                                                    <a href="<?php echo $os_download['download_url']; ?>">
                                                        <?php echo $os_download['download_label']; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                }
                            endwhile;
                        }
                        ?>

                    </div>

                    <h1>Release Notes - <?php echo get_the_title(); ?></h1>
                    <div class="block">
                        <?php the_field('release_notes'); ?>
                    </div>
                </div>

            </article>

		</main>
	</div>

<?php
get_footer();
