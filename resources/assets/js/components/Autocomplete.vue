<template>
    <label class="autocomplete">
        {{ title }}
        <input type="text" class="autocomplete-input"
        v-model="term"
        v-bind:name="name"
        v-bind:placeholder="placeholder"
        v-on:keyup="triggerAutocomplete">

        <ul class="autocomplete-list"
        v-bind:class="{ 'active': isActive }">

            <li class="autocomplete-list-item"
            v-for="item in items"
            v-on:click="selectFromAutocomplete">
                {{ item }}
            </li>
        </ul>
    </label>
</template>

<script>
    export default {
        data: function () {
            return {
                isActive: false,
                term: null,
                items: ['Schiller', 'Goethe']
            }
        },
        props: ['title', 'name', 'placeholder'],
        methods: {
            triggerAutocomplete: function(event) {
                console.log(this.term);

                this.$http.get('/api/authors', function(items) {
                    this.$set('items', items);
                });

                // display autocomplete suggestions
                this.isActive = true;
            },

            selectFromAutocomplete: function(event) {
                this.isActive = false;
            }
        }
    }
</script>

<!--  styles can be found in resources/assets/sass/_components.autocomplete.scss -->
