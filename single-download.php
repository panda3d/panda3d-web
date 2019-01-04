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

// Latest download to compare with
$latest_download = wp_get_recent_posts(array(
	'numberposts' => 1,
    'post_type' => 'download',
    'post_status' => 'publish'
))[0];

$latest_id = $latest_download['ID'];
$is_latest = ($latest_id === get_the_ID());

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="download__header <?php if(!$is_latest) { echo 'download__header--obsolete'; } ?>">
                    <div class="download__header-container">

                        <div class="download__recommended">
                            <h1>Download the Panda3D SDK</h1>

                            <?php if($is_latest) { ?>
                                <p>The latest and most stable release of the Panda3D SDK, released on <?php echo get_the_date(); ?>. Recommended for production use.</p>
                            <?php } else { ?>
                                <?php $latest_release_date = date_i18n(get_option('date_format'), strtotime($latest_download['post_date'])); ?>
                                <p>This version of Panda3D was released on <?php echo get_the_date(); ?> and is now obsolete. The <a href="<?php echo get_permalink($latest_id); ?>">most recent version</a> of Panda3D was released on <?php echo $latest_release_date; ?>. Use at your own risk.</p>
                            <?php } ?>

                            <?php
                            // Attempt to determine primary download from the user's OS
                            if(have_rows('downloads')) {
                                while(have_rows('downloads')): the_row();
                                    $os_id = getOSIdentifier();
                                    $os_icon = $os_data[$os_id][1];
                                    $primary_download = get_sub_field($os_id);
                                endwhile;
                            }
                            ?>

                            <p>
                                <a class="cta cta--primary-ver" href="<?php echo $primary_download[0]['download_url']; ?>">
                                    <span class="cta-ver"><?php echo get_the_title(); ?></span>
                                    <span class="cta-text"><i class="<?php echo $os_icon; ?>"></i> <?php echo $primary_download[0]['download_label']; ?></span>
                                </a>
                            </p>

                            <p><a href="<?php echo get_post_type_archive_link('download'); ?>">...Or choose a different version.</a></p>
                        </div>

                        <div class="download__icon">
                            <i class="fas fa-cloud-download-alt"></i>
                        </div>

                    </div>
                </header>

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
