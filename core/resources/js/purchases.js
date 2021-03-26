import VueI18n from 'vue-i18n';
import messages from './translation';

const purchases = new Vue({
  el: '#purchases',
  i18n: new VueI18n({
    locale: 'fr', // set locale
    fallbackLocale: 'fr',
    messages, // set locale translation
  })
});