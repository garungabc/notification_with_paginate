<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-numbers disabled"><span>&laquo;</span></li>
        <?php else: ?>
            <li class="page-numbers"><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-numbers disabled"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-numbers active"><span><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li class="page-numbers"><a href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-numbers"><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a></li>
        <?php else: ?>
            <li class="page-numbers disabled"><span>&raquo;</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
