<script>
    var isMoving;
    var interval;
    var speed = 6;
    var max = -1400;
    var min = -1868;
    function startOrStop() {
        if(!isMoving) {
            interval = setInterval(moveObject, 20);
            isMoving = true;
        } else {
            isMoving = false;
            clearInterval(interval);
        }
    }

    function moveObject() {
        var e = document.getElementById('object');
        var x = parseInt(e.style.right, 10);
        if(x == max) {
            speed = -6;
        }
        if(x == min) {
            speed = 6;
        }
        e.style.right = (x + speed) + 'px';
    }
</script>

<div id="object" style="width: 3349px; height: 425px; position: absolute; right: -3350px; top: 200px; background-image: url('../movingObject.png'); z-index: 9999" onclick="startOrStop()">
</div>
<div style="width: 200px; height: 200px; position: absolute; right: 0px; top: 700px; background-color: lightgray;" onclick="startOrStop()">
</div>
<?php
?>