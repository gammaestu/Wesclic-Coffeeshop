/**
 * Cart Management Utility
 * Separated for better code organization and potential code splitting
 */

export class CartManager {
    constructor() {
        this.storageKey = 'wesclic_cart';
        this.init();
    }

    init() {
        this.updateCartCount();
    }

    getCart() {
        try {
            return JSON.parse(localStorage.getItem(this.storageKey)) || [];
        } catch (e) {
            console.error('Error reading cart from localStorage:', e);
            return [];
        }
    }

    saveCart(cart) {
        try {
            localStorage.setItem(this.storageKey, JSON.stringify(cart));
            this.updateCartCount();
        } catch (e) {
            console.error('Error saving cart to localStorage:', e);
        }
    }

    addItem(item) {
        const cart = this.getCart();
        const existingItem = cart.find(cartItem => cartItem.id === item.id);

        if (existingItem) {
            existingItem.quantity = (existingItem.quantity || 1) + 1;
        } else {
            cart.push({ ...item, quantity: 1 });
        }

        this.saveCart(cart);
        return cart;
    }

    removeItem(itemId) {
        const cart = this.getCart();
        const filteredCart = cart.filter(item => item.id !== itemId);
        this.saveCart(filteredCart);
        return filteredCart;
    }

    updateQuantity(itemId, quantity) {
        const cart = this.getCart();
        const item = cart.find(cartItem => cartItem.id === itemId);

        if (item) {
            if (quantity <= 0) {
                return this.removeItem(itemId);
            } else {
                item.quantity = quantity;
            }
        }

        this.saveCart(cart);
        return cart;
    }

    getTotalItems() {
        const cart = this.getCart();
        return cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
    }

    getTotalPrice() {
        const cart = this.getCart();
        return cart.reduce((sum, item) => {
            return sum + (item.price * (item.quantity || 1));
        }, 0);
    }

    updateCartCount() {
        const count = this.getTotalItems();
        const cartCountEl = document.getElementById('cart-count');
        if (cartCountEl) {
            cartCountEl.textContent = count;
        }
    }

    clearCart() {
        localStorage.removeItem(this.storageKey);
        this.updateCartCount();
    }
}

// Export singleton instance
export const cartManager = new CartManager();