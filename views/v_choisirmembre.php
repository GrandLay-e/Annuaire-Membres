<form method="post" action="index.php?uc=gerer&action=<?=$action?>">
     <label for="id"> Choisir un membre : </label>
    <select class="form-select" aria-label="Default select example" name="id">
        <?php foreach ($les_membres as $un_membre) : ?>
            <option value="<?=$un_membre['id']?>"><?=$un_membre['nom']." ".$un_membre['prenom'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary"> <?php echo $bouton; ?> </button>
</form>
