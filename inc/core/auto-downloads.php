<?php
/**
 * Automatically populates the fields on the download form.
 *
 * @package Panda3D
 * @author rdb
 */

function panda3d_auto_populate_downloads($post_id, $post) {
    if ($post->post_type != 'download') {
        return;
    }

    $categories = get_the_terms($post_id, 'download_category');
    if (empty($categories)) {
        // Set it up as an SDK by default when we create the download
        $sdk_term = get_term_by('slug', 'sdk', 'download_category');
        if (!empty($sdk_term) && $post->post_status == 'auto-draft' && $post->post_title == 'Auto Draft') {
            wp_set_post_terms($post_id, $sdk_term->term_id, 'download_category');
            update_field('auto_release_notes', true, $post_id);
            update_field('auto_downloads', true, $post_id);
        }
        return;
    }

    $do_auto_relnotes = get_field('auto_release_notes', $post_id);
    $do_auto_downloads = get_field('auto_downloads', $post_id);
    if (!$do_auto_relnotes && !$do_auto_downloads) {
        return;
    }

    $version = get_field('version_number', $post_id);
    if (!isset($version) || empty($version)) {
        return;
    }
    if ($do_auto_relnotes) {
        update_field('auto_release_notes', false, $post_id);
    }
    if ($do_auto_downloads) {
        update_field('auto_downloads', false, $post_id);
    }

    $downloads = array();
    $relnotes = '';

    foreach ($categories as $category) {
        $file_prefix = str_replace('{version}', $version, get_field('file_prefix', $category));
        $url_prefix = str_replace('{version}', $version, get_field('url_prefix', $category));
        $file_prefix = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/' . ltrim($file_prefix, '/');

        if ($do_auto_relnotes) {
            $relnotes_file = str_replace('{version}', $version, get_field('release_notes_file', $category));
            $relnotes_file = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/' . ltrim($relnotes_file, '/');

            if (!empty($relnotes_file) && file_exists($relnotes_file)) {
                $notes = htmlentities(file_get_contents($relnotes_file));
                $notes = preg_match('/(?s)\s*-----+\s*RELEASE\s+' . $version . '\s+-----+\s+(.+?)\s+-----/', $notes, $matches);
                $notes = $matches[1];
                $notes = trim($notes);
                $notes = "<p>\n" . preg_replace('/(?s)\n\n+/', "\n</p>\n<p>\n", $notes) . "\n</p>";
                $notes = preg_replace('/<p>\n([^-* ][^\n]+)\n([-*]\s+.+?)\s+<\/p>/s', "<h4>\$1</h4>\n<ul>\n\$2\n</ul>", $notes);
                $notes = preg_replace('/\n[*-]\s+([^\n]+)/', "\n<li>\$1", $notes);
                $notes = preg_replace('/`([^`]+)`/', '<code>$1</code>', $notes);

                // Remove remaining line feeds, reintroduce them before tags
                $notes = preg_replace('/\s+/', ' ', $notes);
                $notes = preg_replace('/\s+<\/(ul|p)>/', '</$1>', $notes);
                $notes = preg_replace('/<(li|p|h4|ul|\/ul)>\s*/', "\n<\$1>", $notes);
                $notes = trim($notes);

                $github_prefix = get_field('github_issue_url_prefix', $category);
                if (!empty($github_prefix)) {
                    $notes = preg_replace('/#([0-9]+)/', '<a href="' . $github_prefix . '$1" target="_blank" rel="noopener noreferrer">#$1</a>', $notes);
                }

                $relnotes .= $notes;
            }
        }

        if ($do_auto_downloads) {
            $auto_downloads = get_field('auto_downloads', $category);
            foreach ($auto_downloads as $auto_download) {
                $url = str_replace('{version}', $version, $auto_download['url']);

                if ($auto_download['file']) {
                    $file = str_replace('{version}', $version, $auto_download['file']);
                    if (!file_exists($file_prefix . $file)) {
                        continue;
                    }
                    if (!isset($url) || empty($url)) {
                        $url = $url_prefix . $file;
                    }
                }
                $downloads[$auto_download['os']][] = [
                    'download_label' => $auto_download['label'],
                    'download_url' => $url,
                ];
            }
        }
    }

    if (!empty($relnotes) && $do_auto_relnotes) {
        update_field('release_notes', $relnotes, $post_id);
    }
    if (count($downloads) > 0 && $do_auto_downloads) {
        update_field('downloads', $downloads, $post_id);
    }
}

add_action('save_post', 'panda3d_auto_populate_downloads', 10, 2);

?>
