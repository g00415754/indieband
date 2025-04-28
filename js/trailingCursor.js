document.addEventListener("DOMContentLoaded", function () {
    const cursorDot = document.createElement("div");
    cursorDot.id = "cursor-dot";
    document.body.appendChild(cursorDot);
  
    document.body.style.cursor = "none"; // Hides default cursor
  
    let cursor = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
    let dot = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
  
    document.addEventListener("mousemove", function (e) {
        cursor.x = e.clientX;
        cursor.y = e.clientY;
    });
  
    function animateCursor() {
        dot.x += (cursor.x - dot.x) * 0.2; // Trail effect
        dot.y += (cursor.y - dot.y) * 0.2;
  
        cursorDot.style.left = `${dot.x}px`;
        cursorDot.style.top = `${dot.y}px`;
  
        requestAnimationFrame(animateCursor);
    }
  
    function hoverEffect(isHovering) {
        if (isHovering) {
            cursorDot.style.width = "60px";
            cursorDot.style.height = "60px";
            cursorDot.style.mixBlendMode = "difference"; // Inverts colors
        } else {
            cursorDot.style.width = "15px";
            cursorDot.style.height = "15px";
        }
    }
  
    document.querySelectorAll("a, button, .hover-effect").forEach((el) => {
        el.addEventListener("mouseenter", () => hoverEffect(true));
        el.addEventListener("mouseleave", () => hoverEffect(false));
    });
  
    animateCursor();
  });
  