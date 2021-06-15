<div class="col-lg-12">
    <?php if(isset($_SESSION['feedback'])) :?>
       <div class='feedbackbox'><?php echo Session::getAndDestroy('feedback');?></div>
    <?php if(isset($_SESSION['errorfeedback'])) :?>
       <div class='errorbox'><?php echo Session::getAndDestroy('errorfeedback');?></div>
    <?php endif; ?>
</div>