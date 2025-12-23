

<body>
<div class="discover-items">
<div class=container>
<div class="row">


<form action="<?php echo e(route('playlists.index')); ?>" method="GET" role="search" id="search-form" name="gs" style="margin-top: 10px;"> 
    <div class="col-lg-4 d-flex align-items-center gap-2 ms-auto" style="margin-top: 8px; justify-content: flex-end;">
       <input type="text" name="name" placeholder="Playlist Name" value="<?php echo e(request('name')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;">
        <div class="col-lg-2"><button type="submit" style="padding: 5px 10px; width: 90px; display: flex; align-items: center; justify-content: center;">Search</button></div>
    </div>  
</form> 
    

    <div class="item" style="background: transparent; box-shadow: none; padding: 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="margin-top: 20px; padding: 0; margin-left: 20px ; margin-right: 20px;">

                    <!-- create new playlist -->
                    <form action="<?php echo e(route('playlists.store')); ?>" method="POST" role="search" id="search-form" name="gs" style="margin-top: 10px; margin-bottom: 20px;">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="name" placeholder="New Playlist Name" required style="padding: 5px 5px 5px 16px; width: 180px;">
                        <button type="submit" class="action-btn" style="margin-top: 10px; width: 150px; display: flex; align-items: center; justify-content: center;" >Create Playlist</button>
                    </form>

                    <?php if(session('success')): ?>
                      <div style="color: green; margin-top: 10px;"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <table style="margin-top: 20px;">
                      <?php $__currentLoopData = $playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                                <td>
                                    <a href="<?php echo e(route('playlists.show', $playlist->id)); ?>">
                                     <?php echo e($playlist->name); ?> (<?php echo e($playlist->songs_count); ?> songs)
                                 </a>

                                <form action="<?php echo e(route('playlists.destroy', $playlist->id)); ?>" method="POST" style="display:inline; margin-left: 10px;">
                                     <?php echo csrf_field(); ?>
                                     <?php echo method_field('DELETE'); ?>
                                     <button type="submit" onclick="return confirm('Are you sure you want to delete this playlist?')" class="action-btn">Delete</button>
                                </form>

                                </td>
                         </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>

                </div>    
            </div>
        </div>

</div>
</div>
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


<?php echo $__env->make('layouts.liberty', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Eli\cinco-app\resources\views/playlists/index.blade.php ENDPATH**/ ?>