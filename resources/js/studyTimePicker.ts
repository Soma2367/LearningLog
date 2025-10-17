import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import { Japanese } from "flatpickr/dist/l10n/ja.js";

document.addEventListener("DOMContentLoaded", () => {
    const time = document.getElementById('study_time') as HTMLInputElement | null
    if(time) {
        flatpickr(time, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: Japanese,
            allowInput: true,
        })
    }
});
