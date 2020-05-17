import Vue from 'vue';
import vuetify from 'vuetify';
import fa from 'vuetify/src/locale/fa.ts';
// import '@mdi/font/css/materialdesignicons.css';
// import 'material-design-icons-iconfont/dist/material-design-icons.css';

Vue.use(vuetify);

const opts = {
    lang: {
        locales: { fa },
        current: 'fa',
    },
    rtl:true,
    iconfont: 'mdi' // || 'mdiSvg' || 'md' || 'fa' || 'fa4',
}

export default new vuetify(opts)
