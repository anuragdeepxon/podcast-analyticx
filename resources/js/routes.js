export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/blogs', component: require('./components/blog/Blogs.vue').default },
    { path: '/blog/tag', component: require('./components/blog/Tag.vue').default },
    { path: '/blog/category', component: require('./components/blog/Category.vue').default },


    { path: '/', component: require('./components/frontend/Home.vue').default },

    { path: '*', component: require('./components/NotFound.vue').default }
];
