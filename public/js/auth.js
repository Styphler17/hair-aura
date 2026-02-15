(function () {
    'use strict';

    var layer = document.querySelector('.bg-blobs');
    if (!layer) {
        return;
    }

    var targetX = 0;
    var targetY = 0;
    var currentX = 0;
    var currentY = 0;
    var frame = null;
    var maxShift = 12;

    function animate() {
        currentX += (targetX - currentX) * 0.08;
        currentY += (targetY - currentY) * 0.08;
        layer.style.transform = 'translate3d(' + currentX.toFixed(2) + 'px, ' + currentY.toFixed(2) + 'px, 0)';

        if (Math.abs(targetX - currentX) > 0.05 || Math.abs(targetY - currentY) > 0.05) {
            frame = window.requestAnimationFrame(animate);
        } else {
            frame = null;
        }
    }

    function onMouseMove(event) {
        var x = (event.clientX / window.innerWidth - 0.5) * maxShift;
        var y = (event.clientY / window.innerHeight - 0.5) * maxShift;
        targetX = x;
        targetY = y;

        if (!frame) {
            frame = window.requestAnimationFrame(animate);
        }
    }

    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    document.addEventListener('mousemove', onMouseMove, { passive: true });
})();
