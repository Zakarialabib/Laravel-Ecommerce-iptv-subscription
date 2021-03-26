import VueI18n from 'vue-i18n';
import messages from './translation';

const sales = new Vue({
  el: '#sales',
  i18n: new VueI18n({
    locale: 'fr', // set locale
    fallbackLocale: 'fr',
    messages, // set locale translation
  })
});