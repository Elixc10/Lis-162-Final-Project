<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2>Name: <?php echo e($playlist->name); ?></h2>
        <a href="<?php echo e(route('playlists.index')); ?>">Back to Playlists</a>
     <?php $__env->endSlot(); ?>

    <div class="p-6">
        <h3>Songs in this Playlist</h3>
        <ul>
            <?php $__currentLoopData = $playlist->songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php echo e($song->title); ?> by <?php echo e($song->artist); ?>

                    <form action="<?php echo e(route('playlists.removeSong', [$playlist->id, $song->id])); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit">Remove</button>
                    </form>
                    <button 
                         onclick="playSong('<?php echo e(Storage::url($song->audio_path)); ?>', '<?php echo e($song->title); ?> by <?php echo e($song->artist); ?>')"
                         class="action-btn">
                         Play
                    </button>
                </li>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <!-- Music Player Section -->
    <div id="music-player-container" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: #f7f7f7; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1); display: none;">
        <p>Now Playing: <strong id="now-playing-info">None</strong></p>
        <audio controls id="audio-player" style="width: 100%;">
            Your browser does not support the audio element.
        </audio>
    </div>


    <!-- Music Player logic -->
    <script>
        function playSong(audioUrl, songInfo) {
            const player = document.getElementById('audio-player');
            const info = document.getElementById('now-playing-info');
            const container = document.getElementById('music-player-container');

            // Set the audio source and info text
            player.src = audioUrl;
            info.textContent = songInfo;
            
            // Make sure the player UI is visible
            container.style.display = 'block';

            // Play the audio
            player.play();
        }
    </script>
    
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Eli\cinco-app\resources\views/playlists/show.blade.php ENDPATH**/ ?>