<form action="index.php?uc=gerer&action=validerModif" method="post">

    <input type="hidden" name="id" value="<?=$id?>">
    <label for="nouveau-nom"> Nouveau nom : </label>
    <input type="text" name="nouveau-nom" id="nvnom">

    <label for="nouveau-prenom"> Nouveau prénom : </label>
    <input type="text" name="nouveau-prenom" id="nvprenom">

    <button type="submit" class="btn btn-primary">Valider</button>
</form>