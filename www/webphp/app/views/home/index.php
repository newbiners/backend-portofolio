
    <?php include "../app/views/templates/header.html" ?>
    <h1>Home</h1>
    <p>nama saya <?= $data["name"] ?></p>
    <div>
        <?php foreach($data["daftar_film"] as $film):?> <p> <?= $film["title"] ?> </p> <?php endforeach; ?>
    </div>
    <?php include "../app/views/templates/footer.html" ?>


