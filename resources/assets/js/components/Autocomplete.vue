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
            v-for="author in authors">
                {{ author }}
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
                authors: []
            }
        },
        props: ['title', 'name', 'placeholder'],
        methods: {
            triggerAutocomplete: function(event) {
                console.log(this.term);

                this.$http.get('/api/authors', function(authors) {
                    this.$set('authors', authors);
                });

                // display autocomplete suggestions
                this.isActive = true;
            }
        }
    }
</script>

<!--  styles can be found in resources/assets/sass/_components.autocomplete.scss -->
