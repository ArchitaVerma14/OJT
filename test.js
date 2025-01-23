function startAnimation() {
    const egg = document.getElementById('egg');
    const form = document.getElementById('form');

    // Move the egg and open it
    egg.style.transform = 'translateY(100px) scaleY(0.5)';
    
    // Show the form after a delay
    setTimeout(() => {
        form.style.display = 'block';
        form.style.opacity = '1';
    }, 500); // Delay to match the egg opening
}