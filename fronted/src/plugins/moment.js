import moment from "moment"
import VueMomentJS from "vue-momentjs";

export default ({ Vue }) => {
  Vue.use(VueMomentJS, moment);
}
