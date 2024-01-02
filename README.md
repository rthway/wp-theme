There are so many free themes available to you when you are running a WordPress website. Beyond the free themes, you might also choose to pay a premium for professionally made WordPress themes that look great and have fantastic features. So why learn how to create your own theme from scratch? The answer is that no matter what theme you are using, there is going to come a time when you want to make simple changes to your website. Some of those changes might be able to be accommodated by a simple plugin or widget. Many times however, it makes more sense to understand what it is you want to change, how to change it, and avoid turning your WordPress website into a mess of plugins and add-ons that become unwieldy. With just a bit of foundation level knowledge, you’ll be confident in modifying your theme, or simply building your own from scratch. You’ll know which file to edit, and what code to add or modify to create your desired result.

----------

## Step 1: Create a folder to hold your theme files.

If we are going to be building themes, we need to know where the files that make up a WordPress theme live in a WordPress Installation. This is pretty easy. We know that a WordPress installation typically has a root directory named  `wordpress`. Here is what our root directory looks like in PHP Storm.  
![wordpress root directory file system](https://vegibit.com/wp-content/uploads/2017/06/wordpress-root-directory-file-system.png)

This directory contains the following files and folders:

### Files

-   composer.json
-   index.php
-   license.txt
-   readme.html
-   wp-activate.php
-   wp-blog-header.php
-   wp-comments-post.php
-   wp-config.php
-   wp-config-sample.php
-   wp-cron.php
-   wp-links-opml.php
-   wp-load.php
-   wp-login.php
-   wp-mail.php
-   wp-settings.php
-   wp-signup.php
-   wp-trackback.php
-   xmlrpc.php

### Folders

-   wp-admin
-   wp-content
-   wp-includes

The folder that we are most interested in right now is the  **wp-content**  folder. Within the  **wp-content**  folder is a folder named  **themes**. Do you know what this folder is for? Yep, that’s right! It is the folder that holds one or more themes that you would like to use with your WordPress website. In this themes folder we find three additional folders of  **twentyfifteen**,  **twentysixteen**, and  **twentyseventeen**. These folders contain the three themes that WordPress ships with by default. Notice below that there is also a folder named  **customtheme**. Go ahead and create that folder as well in your installation as this is where we will be creating our WordPress theme from scratch.  
![wordpress themes folder](https://vegibit.com/wp-content/uploads/2017/06/wordpress-themes-folder.png)

----------

## Step 2: Create style.css and index.php in your custom theme folder

We now know where WordPress theme files are in the file system. We also have created a new folder named  **customtheme**  in our themes folder. We are now going to create two empty files in this directory. One is called  **index.php**  and the other is called  **style.css**.  
![indexphp and stylecss files](https://vegibit.com/wp-content/uploads/2017/06/indexphp-and-stylecss-files.png)

Let us now populate these files with the bare minimum we need to get a new theme going in WordPress.

----------

#### [style.css](https://developer.wordpress.org/themes/basics/main-stylesheet-style-css/)

WordPress actually reads the comments that you place in the style.css file. This is where you specify specific information about the theme you are building.

> The style.css is a stylesheet (CSS) file required for every WordPress theme. It controls the presentation (visual design and layout) of the website pages.

In our snippet here we simply assign a Theme Name, the Author, the Author URI, and the Version number of our theme.

```css
/*
Theme Name: customtheme
Author: Vegibit
Author URI: https://vegibit.com
Version: 1.0
 */
```

----------

#### index.php

In this file, we just want to output something to the screen to prove that our custom theme is working.

```markup
<h1>Custom Theme!</h1>
```

Markup

Copy

**Great Job!**  Believe it or not, you have created your first WordPress Theme.

----------

## Step 3: Activate your theme from the WordPress Dashboard

At this point we can visit our WordPress Dashboard and navigate to  **Appearance->Themes**  and lo and behold, we see the new theme we have created.  
![wordpress appearance themes link](https://vegibit.com/wp-content/uploads/2017/06/wordpress-appearance-themes-link.png)

We can click on “Theme Details” to drill down on our custom theme and find that the information that we had entered into the style.css file has worked. We can see the them has a name of customtheme, with Version 1.0, by the author Vegibit, and a link to the URI we had provided. Very cool.  
![wordpress theme details](https://vegibit.com/wp-content/uploads/2017/06/wordpress-theme-details.png)

And now the moment of truth! Go ahead and click “Activate” on the new customtheme and then visit the site. It’s not going to win any Webby awards, but we’ve got our selves a good start on a new custom theme!  
![wordpress custom theme](https://vegibit.com/wp-content/uploads/2017/06/wordpress-custom-theme.png)

----------

## Step 4: Add Code to Output The Post Title and Post Text

We’ve take the liberty to populate a couple of example posts in the database so we can work with that data during this tutorial. Right now, our theme just outputs  **Custom Theme!**  to the page when we visit our site no matter how many posts are in the database. Let us now move to fetching some data from the database, and outputting it to the page. Specifically, we want to fetch the Post Title and Post Content of all posts and view them on the homepage. Let’s give that a shot now. First let’s see what we have for posts in the WordPress Dashboard.  
![example wordpress posts in database](https://vegibit.com/wp-content/uploads/2017/06/example-wordpress-posts-in-database.png)

----------

### Leveraging The WordPress Loop

Now we can talk a little bit about the WordPress Loop. The WordPress Loop is really the engine that makes WordPress run. It is via this loop, that theme developers check for posts and display them on the page as needed. If follows the format as follows. If the database has posts, let’s loop over them while there are still posts, otherwise we will let the user know there are no posts. It looks like this in PHP code.

```php
<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

?>

```



Notice that The Loop makes use of two functions in it’s most basic form. Those are  [have_posts()](https://codex.wordpress.org/Function_Reference/have_posts)  and  [the_post()](https://developer.wordpress.org/reference/functions/the_post/). The have_posts() function does only one thing. It tells you if there are any posts in the database to loop over. This function will return either  `true`  or  `false`  and  _that is it_. If it returns  `true`, then there are posts available to loop over. If it returns  `false`, then there are no posts to loop over. The other function, the_post() does not return anything. It’s job is to get WordPress ready to output posts. Specifically, it retrieves the next post, sets up the post, sets the  `in_the_loop`  property to  `true`. So far, our page will still not output any information about our blog posts, but we can update that now in our  **index.php**  file.

```php
<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <h2><?php the_title() ?></h2>
		<?php the_content() ?>
	
	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

?>
```



Ok cool. We have now made use of two additional WordPress functions,  [the_title()](https://codex.wordpress.org/Function_Reference/the_title)  and  [the_content()](https://developer.wordpress.org/reference/functions/the_content/). Most often, these functions are used inside the loop and what they do is to fetch the title and the content of each post as the loop iterates over each one in the database. So as the loop runs, it will come across the first post. At that time the_title() function will output the title of the post to the page and the_content() will output the body of that post to the page. On the next loop these functions will again fetch the next title and content and output them to the page. So with these in place, we should now see some information about our posts getting sent to the screen. Let’s try it! We visit http://wordpresstutorial.dev and see it works!  
![wordpress the_title and the_content](https://vegibit.com/wp-content/uploads/2017/06/wordpress-the_title-and-the_content.png)

----------

## Step 5: Add a Link To Each Post

What about linking to each individual post so that we can view a post on it’s own rather than as part of just the homepage. We can do that quite easily, again with special functions that WordPress provides. For this task, we can make use of the  [the_permalink()](https://codex.wordpress.org/Function_Reference/the_permalink)  function. We can update our code like so:

```php
<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php the_content() ?>
	
	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

?>
```



Now, we can click on each individual post title, and navigate to a page that has just that one post. Very cool!  
![linking to specific posts](https://vegibit.com/wp-content/uploads/2017/06/linking-to-specific-posts.gif)

----------

## Step 6: Add a Header and Footer To The Custom Theme

The Title and the Post Content are central to creating a good theme. Almost as important is having a header and footer section of your theme. These sections would contain the content that is always visible on all pages of the website. These sections are above and below the post content. To do this, you guessed it, we will make use of special functions provided by WordPress to get the header and to get the footer. Do you see a pattern starting to develop yet? Almost anything you can do as a theme developer in WordPress has already been done for you by way of these custom functions. So you will find that it pays to memorize these commonly used functions in WordPress theme development. Let’s go ahead and add the  [get_header()](https://codex.wordpress.org/Function_Reference/get_header)  and  [get_footer()](https://codex.wordpress.org/Function_Reference/get_footer)  functions to our theme file now.

```php
<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php the_content() ?>
	
	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

get_footer();

?>
```


![get_header and get_footer wordpress](https://vegibit.com/wp-content/uploads/2017/06/get_header-and-get_footer-wordpress.png)

Well would you look at that?! We can see that our custom theme now has a header area as well as a footer area. In the header is the name and tagline of the site while in the footer we see the familiar text,  _WordPress Tutorial is proudly powered by WordPress_. These are the default header and footer options when using these functions. What about when we want to have a custom header and footer? Coming right up!

----------

### From 2 Theme Files to 4

So far in this tutorial, we have two files that live in our  **customtheme**  folder (which itself is in the  **themes**  folder). Those files are  **style.css**  and  **index.php**. At this point, we are going to need to add more files to get further along. Go ahead and create two new files in the  **customtheme**  folder. These files will be conveniently called  **header.php**  and  **footer.php**.  
![header and footer php files](https://vegibit.com/wp-content/uploads/2017/06/header-and-footer-php-files.png)

Now what these files will do is to overwrite the default header and footer layouts provided by default when you call either the get_header() or get_footer() functions. In fact, if we refresh our website, it looks like the header and footer are gone. This is because we have not added any markup to those files yet. Just for grins, setup the files like so to test this out.

**header.php**

```markup
<h2>The Header!</h2>
<hr>
```



**footer.php**

```markup
<hr>
<h2>The Footer!</h2>
```



![custom header and footer file output](https://vegibit.com/wp-content/uploads/2017/06/custom-header-and-footer-file-output.png)

----------

#### Working with header.php

Our example above worked great, and it shows us how this file works at it’s most basic level. The header.php file is actually quite important however, so let’s not gloss over the details of it too quickly! This is where you include code that all pages on your site will need access to in one way or another. To start with, all HTML pages will have a doctype. You would specify that in this file. Additionally, all pages will have an opening html tag, a head section, and an opening body tag. All of this can go in the header.php file. Let’s quickly add some of these things that all web pages would make use of. We will make use of a few new  [WordPress functions](https://vegibit.com/the-top-100-most-commonly-used-wordpress-functions/)  here as well. Those will be language_attributes(), bloginfo() and body_class().

**header.php**

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?></title>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
    <h1><?php bloginfo( 'name' ); ?></h1>
    <h4><?php bloginfo( 'description' ); ?></h4>
</header>

```



If we reload the page and then view the source of the page in our browser, we can get an idea of just what these functions are doing. We highlight the lines that have output which came from those functions below:

```markup
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>WordPress Tutorial</title>
</head>

<body class="home blog logged-in admin-bar no-customize-support">
<header class="site-header">
  <h1>WordPress Tutorial</h1>
  <h4>WordPress Tutorial Site</h4>
</header>
<h2><a href="http://wordpresstutorial.dev/2017/06/12/php-tutorial-blog-post/">PHP Tutorial Blog Post</a></h2>
<p>PHP is the language that most of WordPress is built with.  It is a scripting language that has humble roots, but has evolved to become a very powerful and modern language with full support for namespaces, object oriented programming, class reflection, closures, and much more.  This in fact, is just an example post so we can test our custom wordpress theme.  So glad you could read this example WordPress Post.</p>
<h2><a href="http://wordpresstutorial.dev/2017/06/12/wordpress-tutorial-blog-post/">WordPress Tutorial Blog Post</a></h2>
<p>Hello World!  We will write a short tutorial here about WordPress.  Of course this is just dummy text for this post so that we can have something to read.  Maybe you like swimming during the summer.  Eating hamburgers at the cook out is fun for all.  On Monday, you can go back to WordPress Website Development.  There are many things to do.</p>
<ul>
  <li>Commute to office</li>
  <li>Update WordPress Theme</li>
  <li>Finish Statistics Reports</li>
</ul>
<p>This is the end of this dummy post.</p>
</body>
</html>

```



Again, we can see the very liberal use of WordPress functions when developing your own themes in WordPress. In fact, we have not written any custom code at all yet. We are simply learning what the various WordPress functions can offer us, and then putting them to work in our custom theme.

----------

### Including wp_head()

wp_head() is kind of a special function when you’re working with WordPress Themes. It’s not quite as simple as all the others we have looked at so far. The purpose of this function is to finalize the output in the <head> section of your header.php file. In fact it is meant to go just prior to the closing </head> tag. This becomes important when you start adding various plugins to your site. It prints scripts or data in the head tag on the front end. It is a good practice to always include wp_head() in your themes as many other plugins may rely on this hook to add styles, scripts, or meta elements into the <head> area of the site. We will add it as such here:

**header.php**

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?></title>
	<?php wp_head() ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
    <h1><?php bloginfo( 'name' ); ?></h1>
    <h4><?php bloginfo( 'description' ); ?></h4>
</header>
```



----------

#### Completing footer.php

We have finished adding the basics of what we will need in the header.php file. Let’s now go ahead and round out the footer.php file. The are a few things we need to do. Recall that in our header.php file we have opening html and body tags. Those need to be closed at some point. The footer.php file is a perfect place to do that. So we will add closing </html> and </body> tags in addition to making a call to the  [wp_footer()](https://codex.wordpress.org/Function_Reference/wp_footer)  function.  
**footer.php**

```php
<footer class="site-footer">
    <p><?php bloginfo( 'name' ) ?></p>
</footer>

<?php wp_footer() ?>
</body>
</html>
```



----------

### Changing Site Information In The WordPress Dashboard

You might be wondering why we had to make use of all these fancy functions to build up our theme. For example, when we wanted to list out the name and tagline of our site, we made use of the bloginfo() function passing parameters of name and description. The reason for this is because generally, you never want to hard code these values into your site. This is information that might change. Additionally, if you make your theme available to the public, they will have their own name and tagline for their website. They should be able to simply visit the admin dashboard in WordPress and update their General Settings to see this data populate automatically.

----------

### Making The Site Title Link To The Homepage

Most themes will offer the ability to click on the title text of the website, and direct the user to the homepage of the site. This way, no matter where the user may be on the site, they can always click that title text and go right back to the main page of the website. Let’s add that link now in header.php.

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?></title>
	<?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header">
    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <h4><?php bloginfo( 'description' ); ?></h4>
</header>
```



----------

## Step 7: Add a functions.php file to your theme

At this point, we have four files in our custom theme. Those are  **index.php**,  **style.css**,  **header.php**, and  **footer.php**. Probably the next most important file we need to have is the  **[functions.php](https://codex.wordpress.org/Functions_File_Explained)**  file.

The functions.php file in WordPress does many things for your theme. It is the file where you place code to modify the default behavior of WordPress. You can almost think of the functions.php as a form of a plugin for WordPress with a few key points to remember:

-   Does not require unique Header text
-   Stored in the folder that holds your theme files
-   Executes only when in the currently activated theme’s directory
-   Applies only to the current theme
-   Can call PHP functions, WordPress functions, or custom functions

One thing we need badly in our theme is some better styling! Let’s create a function in our functions.php file to include the style.css file into our theme. Here is how we can achieve that goal.

```php
<?php

function custom_theme_assets() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );
```



This piece of code will include, or make active, the stylesheet of our custom theme. Now you might be wondering why we are using a custom function, when it seems like we could just as easily manually link to the stylesheet ourselves in the header.php file. Well, this comes down to doing a little more work up front for a bigger return on your effort later. As themes get more complex and more assets are added, you will be happy to have this one function that can handle all the heavy lifting for you.

Now it’s time to makes things look a little more pretty. First, let’s add a wrapping <div> with a class of container. The opening <div> will be in header.php, while the closing <div> will be in footer.php. We’ll also wrap the post output in index.php with an <article> tag that has a class of post. This will give us classes to target in our style.css file so that we can set page width among other things. We’ll also add some better styling to style.css in this step.

----------

## Step 8: Add Some Style To Your Theme

**header.php**  
Adding an opening <div> to the header.php file.

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?></title>
	<?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
<div class="container">
    <header class="site-header">
        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <h4><?php bloginfo( 'description' ); ?></h4>
    </header>
```



**footer.php**  
Adding a closing </div> to the footer.php file.

```php
<footer class="site-footer">
    <p><?php bloginfo( 'name' ) ?></p>
</footer>
</div> <!-- closes <div class=container"> -->

<?php wp_footer() ?>
</body>
</html>
```



**index.php**  
Wrapping the post output with an <article> tag

```php
<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <article class="post">
            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
			<?php the_content() ?>
        </article>
	
	<?php endwhile;

else :
	echo '<p>There are no posts!</p>';

endif;

get_footer();

?>
```



**style.css**  
Finally, we add some various CSS style improvements to make the theme look a bit nicer.

```css
/*
Theme Name: customtheme
Author: Vegibit
Author URI: https://vegibit.com
Version: 1.0
 */

body {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #545454;
}

a:link, a:visited {
    color: #4285f4;
}

p {
    line-height: 1.7em;
}

div.container {
    max-width: 960px;
    margin: 0 auto;
}

article.post {
    border-bottom: 4px dashed #ecf0f1;
}

article.post:last-of-type {
    border-bottom: none;
}

.site-header {
    border-bottom: 3px solid #ecf0f1;
}

.site-footer {
    border-top: 3px solid #ecf0f1;
}
```



When we visit our test website now in the browser, we can see that the WordPress Theme that we have developed step by step in this tutorial is looking pretty good!  
![wordpress theme development from scratch](https://vegibit.com/wp-content/uploads/2017/06/wordpress-theme-development-from-scratch.png)

----------

### WordPress Theme Development Tutorial Step By Step Summary

Let’s review everything that we’ve learned in this basic step by step WordPress Theme tutorial for beginners. We’ve learned how to create our first custom theme in WordPress by making our own folder in side of the themes folder of our WordPress installation. In this folder, we added different files that correspond to different sections of your website. In our tutorial, we have started with the bare minimums you should have in a WordPress theme. In the future, you would add many more files to this folder than what we have covered. Let’s review each file we created in this tutorial, and what they did for us.

-   **style.css**  This file is where you add some css comments so that WordPress knows some information about your custom theme. It also holds the custom css styling that you will apply to your theme.
-   **index.php**  This file controls the html and general output of your theme. It is the main file used for outputting data on your home page.
-   **header.php**  Allows you to specify an area to hold important information about your website in the <head> area as well as including opening <html>, <body>, and ,<div class=”container”> tags.
-   **footer.php**  The footer will close out any opening tags you specified in the header area, in addition to giving you a place to call the wp_footer() function.
-   **functions.php**  Allows you to to call functions, both PHP and built-in WordPress, and to define your own functions in order to change the default behaviors of WordPress

So there you have it! We were able to create a fully functioning custom WordPress Theme with only 5 files. This gives us the foundation level knowledge to build more advanced WordPress themes and functions. Great Job!
