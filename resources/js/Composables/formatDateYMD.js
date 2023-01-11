import { unref } from "vue";
import moment from 'moment';

export function formatDate(date) {
    const unrefDate = unref(date)
    return moment(unrefDate).format('YYYY-MM-DD')
}
