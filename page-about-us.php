<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <article class="page-layout">
            <table border="0" width="100%">
                <tr>
                    <td width="30%"><h2><?php the_title() ?></h2></td>
                    <td><?php the_content() ?></td>
                </tr>
            </table>
        </article>
	
	<?php endwhile;

else :
	echo '<p>There are no pages!</p>';
endif;

get_footer();

?>