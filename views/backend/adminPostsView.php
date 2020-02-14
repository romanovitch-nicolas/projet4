<?php $title = "Gestion des chapitres" ?>

<?php ob_start(); ?>
<h1>Gestion des chapitres</h1>

<?php
$postExist = $posts->rowCount();
if($postExist) {
?>

<section id="adminposts">
	<table>
		<tr>
			<th>Date</th>
			<th>Image</th>
			<th>Chapitre</th>
			<th>Extrait</th>
			<th>Action</th>
		</tr>
		<?php
		while ($data = $posts->fetch())
		{
		?>
			<tr>
				<td class="date"><?= $data['creation_date_fr'] ?></td>
				<td><?php if (!empty($data['image_name'])) { ?>
					<img src="public/images/<?= $data['image_name'] ?>" />
					<?php } ?></td>
				<td><a class="bold" href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= $data['title'] ?></a></td>
				<td><?php 
			        $postDescription = nl2br(strip_tags(htmlspecialchars_decode($data['content'])));
			        echo substr($postDescription, 0, 200) . '...';
		        	?></td>
				<td>
					<a href="index.php?action=adminEditPost&amp;id=<?= $data['id'] ?>" title="Modifier"><i class="fas fa-edit"></i></a>
					<a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" title="Supprimer" onclick="if(confirm('Supprimer définitivement ?')){return true;}else{return false;}"><i class="fas fa-trash"></i></a>
					<?php if($data['online'] == 0) { ?>
						<a href="index.php?action=onlinePost&amp;id=<?= $data['id'] ?>" title="Rendre public"><i class="fas fa-eye-slash"></i></a>
					<?php } else { ?>
						<a href="index.php?action=offlinePost&amp;id=<?= $data['id'] ?>" title="Rendre privé"><i class="fas fa-eye"></i></a>
					<?php } ?></td>
			</tr>
		<?php
		}
		$posts->closeCursor();
		?>
	</table>
</section>

<?php
} else {
?>
	<p><em>Pas de chapitres.</em></p>
<?php 
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?> 