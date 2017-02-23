<template>
    <label class="autocomplete">
        {{ title }}
        <input type="hidden"
        v-model="id"
        v-bind:name="name + '_id'" value="">

        <input type="text" class="autocomplete-input"
        v-model="term"
        v-bind:name="name"
        v-bind:placeholder="placeholder"
        v-on:keyup="triggerAutocomplete"
        v-on:blur="">

        <ul class="autocomplete-list"
        v-bind:class="{ 'active': isActive }">

            <li class="autocomplete-list-item"
                v-for="item in items"
                v-on:click="selectFromAutocomplete(item)">
                {{ item.name }} <sup>[{{ item.id }}]</sup>
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
                id: null,
                items: []
            }
        },
        props: ['title', 'name', 'placeholder'],
        methods: {
            triggerAutocomplete: function(event) {
                var url = '/api/' + this.name + '/' + this.term

                this.$http.get(url).then(function(response) {
                    this.items = response.body[0];
                    // display autocomplete suggestions
                    this.isActive = true;
                });
            },

            resetAutocomplete: function() {
                this.isActive = false;
                this.items = [];
            },

            selectFromAutocomplete: function(item) {
                this.term = item.name;
                this.id = item.id;
                this.resetAutocomplete();
            }
        }
    }
</script>

<!--  styles can be found in resources/assets/sass/_components.autocomplete.scss -->
