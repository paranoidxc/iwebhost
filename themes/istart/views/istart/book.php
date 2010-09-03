<div class="books-wrap">
<div class="chapters">	
	<ul>
		<?php
		if( $book->acticles ){					
	 		foreach($book->articles as $chapter) {
			echo '<li><a href="'.CController::createurl('istart/chapter', array('id' => $chapter->id, 'ajax' => 'ajax' )). '">'.$chapter->title.'</a></li>';
			}
		}?>		
	</ul>
</div>

<?php
	if( $chapter ){		
		$this->renderPartial('chapter', array('chapter' => $chapter ));
	}
?>		
</div>