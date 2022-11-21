import {unref} from "vue";

export function useTruncate(text, length, suffix) {
    const unrefText = unref(text)

    if (unrefText.length > length) {
        return unrefText.substring(0, length) + suffix;
    } else {
        return unrefText;
    }
}
