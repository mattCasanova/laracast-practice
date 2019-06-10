<?php require('partials/head.php'); ?>

<?php foreach ($users as $user) { ?>
    <h4><?php echo $user->name; ?></h4>
    <ul>
        <li><?php echo "ID: {$user->id}"; ?></li>
    </ul>
<?php } ?>

<h1>Submit Your Name</h1>

<form method="POST" action="/users">
    <input name="name"/>
</form>



<?php require('partials/footer.php'); ?>