<template>
    <tile :position="position" modifiers="overflow">
        <section class="jira">
            <h1 class="jira__title">{{ teamMember }}</h1>

            <ul class="jira__content">
                <li v-for="issue in issues">
                    <span class="jira__key">{{ issue.key }}</span>

                    {{ issue.summary }}
                </li>
            </ul>
        </section>
    </tile>
</template>

<script>
    import echo from '../mixins/echo';
    import Tile from './atoms/Tile';
    import saveState from 'vue-save-state';

    export default {

        components: {
            Tile,
        },

        mixins: [echo, saveState],

        props: ['teamMember', 'position'],

        data() {
            return {
                issues: '',
            };
        },

        methods: {
            getEventHandlers() {
                return {
                    'Jira.IssuesFetched': response => {
                        this.issues = response.issues[this.teamMember];
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: `issues-${this.teamMember}`,
                };
            },
        },
    };
</script>
