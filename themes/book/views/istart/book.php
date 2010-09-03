<div class="books-wrap">
<div class="chapters">	
	<ul>
		<?php
		if( $book->articles ){					
	 		foreach($book->articles as $chapter) {
			echo '<li><a href="'.CController::createurl('istart/chapter', array('id' => $chapter->id, 'ajax' => 'ajax' )). '">'.$chapter->title.'</a></li>';
			}
		}?>		
	</ul>
</div>
4444444444
<div class="chapter_handle">
</div>
<?php
	if( $chapter ){		
		$this->renderPartial('chapter', array('chapter' => $chapter ));
	}
?>		
</div>