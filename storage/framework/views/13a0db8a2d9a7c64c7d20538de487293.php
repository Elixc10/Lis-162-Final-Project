<body>
<div class="discover-items">
<div class=container>
<div class="row">
    
    
        <form action="<?php echo e(route('dashboard')); ?>" method="GET" role="search" id="search-form" name="gs">
        <div class="row align-items-center">
        <div class="col-lg-2"><input type="text" name="title" placeholder="Title" value="<?php echo e(request('title')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;"></div>
        <div class="col-lg-2"><input type="text" name="artist" placeholder="Artist" value="<?php echo e(request('artist')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;"></div>
        <div class="col-lg-2">
            <select name="genre" class="form-select" style="padding: 5px 5px 5px 16px; width: 180px;">
                <option value="">Genre</option>
                <option value="Pop" <?php echo e(request('genre') == 'Pop' ? 'selected' : ''); ?>>Pop</option>
                <option value="Hip-hop" <?php echo e(request('genre') == 'Hip-hop' ? 'selected' : ''); ?>>Hip-hop</option>
                <option value="Jazz" <?php echo e(request('genre') == 'Jazz' ? 'selected' : ''); ?>>Jazz</option>
                <option value="Electronic" <?php echo e(request('genre') == 'Electronic' ? 'selected' : ''); ?>>Electronic</option>
                <option value="Country" <?php echo e(request('genre') == 'Country' ? 'selected' : ''); ?>>Country</option>
                <option value="Classical" <?php echo e(request('genre') == 'Classical' ? 'selected' : ''); ?>>Classical</option>
                <option value="Rock" <?php echo e(request('genre') == 'Rock' ? 'selected' : ''); ?>>Rock</option>
            </select>
        </div>
        <div class="col-lg-2"><input type="text" name="language" placeholder="Language" value="<?php echo e(request('language')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;"></div>
        <div class="col-lg-2"><input type="number" name="year_min" placeholder="Year Min" value="<?php echo e(request('year_min')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;"></div>
        <div class="col-lg-2"><input type="number" name="year_max" placeholder="Year Max" value="<?php echo e(request('year_max')); ?>" style="padding: 5px 5px 5px 16px; width: 180px;"></div>

            <?php if(auth()->guard()->check()): ?>
            <div class="col-lg-4 d-flex align-items-center gap-2 ms-auto" style="margin-top: 8px; justify-content: flex-end;">
                <a href="<?php echo e(route('songs.create')); ?>" style="width: 120px; display: flex; align-items: center; justify-content: center;">
                    <button type="button" class="action-btn" style="width: 100%; height: 44px; display: flex; align-items: center; justify-content: center;">Add New Song</button>
                </a>
                    <button type="submit" style="padding: 5px 10px; width: 90px; display: flex; align-items: center; justify-content: center;">Search</button>
                <a href="<?php echo e(route('dashboard')); ?>" style="width: 90px; display: flex; align-items: center; justify-content: center;">
                    <button type="button" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">Clear</button>
                </a>
            </div>
        </div>
        </div>
            <?php else: ?>
            <div class="row align-items-center">
                <div class="col-lg-2 d-flex align-items-center gap-2 ms-auto" style="margin-top: 8px; justify-content: flex-end;">
                        <button type="submit" style="padding: 5px 10px; width: 90px; display: flex; align-items: center; justify-content: center;">Search</button>
                        <a href="<?php echo e(route('dashboard')); ?>" style="width: 90px; display: flex; align-items: center; justify-content: center;">
                        <button type="button" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">Clear</button>
                        </a>
                </div>
            </div>
            <?php endif; ?>
        </form>

    <div class="item" style="background: transparent; box-shadow: none; padding: 0;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="margin-top: 20px; padding: 0;">
                <?php if(session('success')): ?>
                    <div style="color: green; margin-bottom: 10px;">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <div style="max-width: 1100px; margin: 0 auto;">
                    <table class="table" style="width: 100%; background: transparent;">
                        <thead>
                            <tr style="color: #f7f7f7;">
                                <th class="text-left" style="font-size: 1.35rem;">Title</th>
                                <th class="text-left" style="font-size: 1.35rem;">Artist</th>
                                <th class="text-center" style="font-size: 1.35rem;">Year</th>
                                <th class="text-center" style="font-size: 1.35rem;">Genre</th>
                                <th class="text-center" style="font-size: 1.35rem;">Language</th>
                                <th class="text-center" style="width: 280px; font-size: 1.35rem;">Actions</th>
                            </tr>
                           
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr style="color: #f7f7f7; background: transparent;">
                                <td class="text-left p-3"><?php echo e($song->title); ?></td>
                                <td class="text-left p-3"><?php echo e($song->artist); ?></td>
                                <td class="text-center p-3"><?php echo e($song->year); ?></td>
                                <td class="text-center p-3"><?php echo e($song->genre); ?></td>
                                <td class="text-center p-3"><?php echo e($song->language); ?></td>
                                <td class="text-center p-3">
                                    <div class="song-actions">

                                        <!-- Play -->
                                        <button
                                            onclick="playSong('<?php echo e(Storage::url($song->audio_path)); ?>', '<?php echo e($song->title); ?> by <?php echo e($song->artist); ?>')"
                                            class="action-btn song-action">
                                            Play
                                        </button>

                                        <?php if(auth()->guard()->check()): ?>
                                            <!-- Edit -->
                                            <a href="<?php echo e(route('songs.edit', $song->id)); ?>"
                                               class="action-btn song-action text-decoration-none">
                                                Edit
                                            </a>

                                            <!-- Delete -->
                                            <form action="<?php echo e(route('songs.destroy', $song->id)); ?>"
                                                  method="POST"
                                                  style="margin: 0;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                        class="action-btn song-action"
                                                        onclick="return confirm('Are you sure?')">
                                                    Del
                                                </button>
                                            </form>

                                            <!-- Add to playlist -->
                                            <form action="<?php echo e(route('playlists.addSong')); ?>"
                                                  method="POST"
                                                  style="margin: 0;">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="song_id" value="<?php echo e($song->id); ?>">

                                                <select name="playlist_id"
                                                        class="song-action"
                                                        onchange="this.form.submit()">
                                                    <option value="">+ Playlist</option>
                                                    <?php $__currentLoopData = $userPlaylists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option style="color: #000000ff;"  value="<?php echo e($playlist->id); ?>">
                                                            <?php echo e($playlist->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </form>
                                        <?php endif; ?>

                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
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
</body>
<?php echo $__env->make('layouts.liberty', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Eli\cinco-app\resources\views/dashboard.blade.php ENDPATH**/ ?>