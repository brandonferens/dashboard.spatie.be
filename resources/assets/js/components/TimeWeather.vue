<template>
    <tile :position="position">
        <section class="time-weather">
            <time class="time-weather__content">
                <span class="time-weather__city">{{ city }}</span>
                <span class="time-weather__date">{{ date }}</span>
                <span class="time-weather__time">{{ time }}</span>
                <span class="time-weather__weather">
                    <span class="time-weather__weather__temperature">{{ weather.temperature }}</span>
                    <span class="time-weather__weather__description">
                        <i class="wi" :class="weather.iconClass"></i>
                    </span>
                </span>
            </time>
        </section>
    </tile>
</template>

<script>
    import Tile from './atoms/Tile';
    import moment from 'moment-timezone';
    import weather from '../services/weather/Weather';

    export default {

        components: {
            Tile,
        },

        props: {
            city: {
                type: String,
                default: 'Seattle',
            },
            dateFormat: {
                type: String,
                default: 'DD-MM-YYYY',
            },
            timeFormat: {
                type: String,
                default: 'h:mm:ss',
            },
            timezone: {
                type: String,
                default: 'America/Los_Angeles',
            },
            position: {
                type: String,
            },
        },

        data() {
            return {
                date: '',
                time: '',
                weather: {
                    temperature: '',
                    iconClass: '',
                },
            };
        },

        created() {
            this.refreshTime();
            setInterval(this.refreshTime, 1000);

            this.fetchWeather();
            setInterval(this.fetchWeather, 15 * 60 * 1000);
        },

        methods: {
            refreshTime() {
                this.date = moment().format(this.dateFormat);
                this.time = moment().tz(this.timezone).format(this.timeFormat);
            },

            async fetchWeather() {
                const conditions = await weather.conditions(this.city);

                this.weather.temperature = conditions.temp;
                this.weather.iconClass = `wi-yahoo-${conditions.code}`;
            },
        },
    };
</script>
