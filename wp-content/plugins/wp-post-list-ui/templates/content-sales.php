<section id="post-<?php  the_ID();?>" class="spotlight">
         <div class="image"><img src=<?php print_template_uri("images/alquiler.jpg");?> alt="" /></div><div class="content">
             <?php  the_title('<h2>', '</h2>');?>
             <p><?php  the_content();?></p>
         </div>
     </section>