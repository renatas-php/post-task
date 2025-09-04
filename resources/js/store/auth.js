// src/composables/auth.js
import { ref } from 'vue'
import axios from 'axios'

export const isLogged = ref(false)
export const user = ref(null)

export async function checkOrLogged() {
  try {
    const response = await axios.get('/api/front/me')
    isLogged.value = !!response.data.data
    user.value = response.data.data
  } catch (e) {
    isLogged.value = false
    user.value = null
  }
}