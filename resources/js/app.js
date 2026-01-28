import './bootstrap';

// Import utilities (code splitting ready)
import { cartManager } from './utils/cart';
import { notificationManager } from './utils/notifications';
import { lazyLoader } from './utils/lazy-loading';

// Make cart manager globally available
window.cartManager = cartManager;

// Global add to cart handler
window.addToCartHandler = function(item) {
    cartManager.addItem(item);
    notificationManager.show(`${item.name} added to cart!`, 'success');
};

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    cartManager.updateCartCount();
    // Lazy loader is auto-initialized
});
