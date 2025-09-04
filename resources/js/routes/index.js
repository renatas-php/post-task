import { createRouter, createWebHistory } from "vue-router";

import Login from '@/views/front/auth/login.vue';
import Register from '@/views/front/auth/register.vue';
import RememberPassword from '@/views/front/auth/password-reset.vue';
import ChangePassword from '@/views/front/auth/resetPassword.vue';
//Posts
import Posts from '@/views/front/posts/index.vue';
import Post from '@/views/front/posts/post.vue';
import MyPosts from '@/views/front/posts/my-posts.vue';

const routes = [
    //Front
    {
      path: '/prisijungti',
      name: 'prisijungti',
      component: Login
    },
    {
      path: '/registracija',
      name: 'registracija',
      component: Register
    },
    {
      path: '/slaptazodzio-keitimas',
      name: 'reset-password',
      component: ChangePassword
    },
    {
      path: '/slaptazodzio-priminimas',
      name: 'remember-password',
      component: RememberPassword
    },
    //Posts
    {
      path: '/',
      name: 'posts',
      component: Posts
    },
    {
      path: '/posts/:slug',
      name: 'post',
      component: Post
    },
    {
      path: '/my-posts',
      name: 'my-posts',
      component: MyPosts
    },
    {
      path: '/my-posts/:id',
      name: 'my-posts-edit',
      component: MyPosts
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
      if (to.hash) {
        // This ensures that if hash is provided to router.push it works as expected.
        //  & since we have used "behavior: 'smooth'" the browser will slowly come to this hash position.
        return {
          top: 0,
          el: to.hash,
          behavior: 'smooth',
        }
      }
      else
      {
        return { top: 0, behavior: 'smooth' }
      }
    },
    
});

router.beforeEach((to, from, next) => {
  next();
  /*if (to.matched.some((record) => record.meta.admin)) {
    const useAuth = Auth();
    if(!useAuth.isAdmin) {
      next("/admin/login");
      return;
    }
    else {
      next();
    }
  }
  else {
    next();
  }  */
});



export default router;