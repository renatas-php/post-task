import { defineStore } from "pinia";

const Cart = defineStore("cart", {
  state: () => ({
    items: [],
  }),
  getters: {
    //cart: (state) => basket,
    totalItems: (state) => state.items.length,
  },
  actions: {
    addItem(product) {
      const existingItem = this.items.find((item) => item.id === product.id && item.size === product?.size && item.wish === product?.wish);
      if (existingItem) {
        //existingItem.quantity += 1;
      } else {
        this.items.push({ ...product, quantity: 1 });
      }
    },
    removeItem(productId, size) {
      const index = this.items.findIndex((item) => item.id === productId && item.size === size);
      this.items.splice(index, 1);// = this.items.filter((item) => item.size != size && item.id !== productId);
    },
    updateQuantity(productId, quantity) {
      const item = this.items.find((item) => item.id === productId);
      if (item) item.quantity = quantity;
    },
    clearBasket() {
      this.items = [];
    },
  },
  persist: true,
});

export { Cart };