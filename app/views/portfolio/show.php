<?php
$page_data = ['title' => 'Портфолио 1', 'description' => 'Page About', 'keywords' => 'page, about', 'og' => ['title' => 'ogTitle', 'description' => 'Page About', 'keywords' => 'page, about']];
include $_SERVER['DOCUMENT_ROOT'].'/static/blocks/head.php';
include $_SERVER['DOCUMENT_ROOT'].'/static/blocks/header.php';
echo $_SERVER['DOCUMENT_ROOT'];
?>

<h1><?php echo htmlspecialchars($item['title']).'_'.$id; ?></h1>

<?php foreach ($blocks as $block): ?>
    <div class="portfolio-block">
        <?php if ($block['type'] == 'text'): ?>
            <p><?php echo htmlspecialchars($block['content']); ?></p>
        <?php elseif ($block['type'] == 'image'): ?>
            <img src="/public/images/mainPage/<?php echo htmlspecialchars($block['content']); ?>" alt="Portfolio Image">
        <?php elseif ($block['type'] == 'youtube'): ?>
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($block['content']); ?>" frameborder="0" allowfullscreen></iframe>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

</body>
</html>