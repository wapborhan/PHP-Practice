<?php 
include 'include/config.php';
include 'include/functions.php';
$post_view_query = "SELECT * FROM posts WHERE status = 'Active' ORDER BY id desc";
$post_view_query_result = mysqli_query($conn, $post_view_query);
$base_url = sitelink()."/";
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
while($row = mysqli_fetch_array($post_view_query_result))
{
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'article/'. $row["id"] .'</loc>' . PHP_EOL;
 echo '<lastmod>'. $row["datetime"] .'</lastmod>' . PHP_EOL;
 echo '<changefreq>monthly</changefreq>' . PHP_EOL;
 echo '<priority>0.2</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'about-us.php'.'</loc>' . PHP_EOL;
 echo '<changefreq>weekly</changefreq>' . PHP_EOL;
 echo '<priority>0.6</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'contact-us.php'.'</loc>' . PHP_EOL;
 echo '<changefreq>weekly</changefreq>' . PHP_EOL;
 echo '<priority>0.6</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'advertise.php'.'</loc>' . PHP_EOL;
 echo '<changefreq>weekly</changefreq>' . PHP_EOL;
 echo '<priority>0.6</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url.'privacy-policy.php'.'</loc>' . PHP_EOL;
 echo '<changefreq>weekly</changefreq>' . PHP_EOL;
 echo '<priority>0.6</priority>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
echo '</urlset>' . PHP_EOL;

?>
