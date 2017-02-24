<template>
    <label class="autocomplete">
        {{ title }}
        <input type="hidden"
               v-model="id"
               v-bind:name="name + '_id'" value="">

        <input type="text" class="autocomplete-input" autocomplete="off"
               v-model="term"
               v-bind:name="name"
               v-bind:placeholder="placeholder"
               v-on:keyup="triggerAutocomplete">

        <ul class="autocomplete-list"
            v-bind:class="{ 'active': items.length }">

            <li class="autocomplete-list-item"
                v-for="item in items"
                v-on:click="selectFromAutocomplete(item)">
                {{ item.name }} <sup>[{{ item.id }}]</sup>
            </li>
        </ul>

        <div class="autocomplete-backdrop"
             v-if="items.length"  
             v-on:click="resetAutocomplete"></div>
    </label>
</template>

<script>
    export default {
        data: function () {
            return {
                term: null,
                id: null,
                items: []
            }
        },
        props: ['title', 'name', 'table', 'placeholder'],
        methods: {
            triggerAutocomplete: function(event) {
                this.id = null;

                var url = '/api/' + this.table + '/' + this.term

                this.$http.get(url).then(function(response) {
                    this.items = response.body[0];
                });
            },

            resetAutocomplete: function() {
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
