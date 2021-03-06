import moment from 'moment';

export function formatNumber(value) {
    if (! value) {
        return 0;
    }

    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

export function addClassModifiers(base, modifiers = []) {
    if (! Array.isArray(modifiers)) {
        modifiers = modifiers.split(' ');
    }

    modifiers = modifiers.map(modifier => `${base}--${modifier}`);

    return [base, ...modifiers];
}

export function formatDuration(start) {
    let duration = moment.duration(moment().diff(start), 'milliseconds');

     return `${duration.days()}d ${duration.hours()}h ${duration.minutes()}m`;
}

export function relativeDate(value, allDay = false) {
    const date = moment(value);
    const format = date.minute() === 0 ? 'h a' : 'h:mm a';

    if (moment().isSame(date, 'd')) {
        if (allDay) {
            return 'Today all day';
        }

        return 'Today at ' + date.format(format);
    }

    if (moment().add(1, 'day').isSame(date, 'd')) {
        if (allDay) {
            return 'Tomorrow all day';
        }

        return 'Tomorrow at ' + date.format(format);
    }

    if (date.isBetween(moment().add(1, 'day'), moment().add(8, 'days'), 'day')) {
        let allDayText = allDay ? 'all day' : '';

        return `${date.format('dddd')} ${allDayText}`;
    }

    return 'In ' + date.toNow(true);
}

export function relativeDateTime(value) {
    const date = moment(value);

    if (moment().diff(date, 'days') > 5) {
        return 'A long long time ago';
    }

    if (moment().diff(date, 'days') > 1) {
        return `${moment().diff(date, 'days')} days ago`;
    }

    if (moment().diff(date, 'hours') >= 24) {
        return 'A day ago';
    }

    if (moment().diff(date, 'hours') > 1) {
        return `${moment().diff(date, 'hours')} hours ago`;
    }

    if (moment().diff(date, 'minutes') > 59) {
        return 'An hour ago';
    }

    if (moment().diff(date, 'seconds') > 119) {
        return `${moment().diff(date, 'minutes')} minutes ago`;
    }

    if (moment().diff(date, 'seconds') >= 60) {
        return 'A minute ago';
    }

    return 'Just now';
}

export function diffInSeconds(otherMoment) {
    return moment().diff(otherMoment, 'seconds');
}

export function positionToGridAreaNotation(position) {
    const [from, to = null] = position.toLowerCase().split(':');

    if (from.length !== 2 || (to && to.length !== 2)) {
        return ;
    }

    const areaFrom = `${from[1]} / ${indexInAlphabet(from[0])}`;
    const area = to ? `${areaFrom} / ${Number(to[1]) + 1} / ${indexInAlphabet(to[0]) + 1}` : areaFrom;

    return area ;
}

function indexInAlphabet(character) {
    const index = character.toLowerCase().charCodeAt(0) - 96;
    return index < 1 ? 1 : index;
}


