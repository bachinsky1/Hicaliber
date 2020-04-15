<template>
  <div>
    <loading :active.sync="isLoading" :is-full-page="fullPage" />
    <h1 class="text-center">{{ msg }}</h1>
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <b-form @submit.stop.prevent>
              <div class="row">
                <div class="col-md-6">
                  <b-form-group
                    description="Enter name"
                    label="Name"
                    label-for="name"
                  >
                    <b-form-input
                      id="name"
                      size="sm"
                      v-model="form.name"
                      trim
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    description="Enter bedrooms count"
                    label="Bedrooms"
                    label-for="bedrooms"
                  >
                    <b-form-input
                      id="bedrooms"
                      type="number"
                      min="0"
                      size="sm"
                      v-model="form.bedrooms"
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    description="Enter storeys count"
                    label="Storeys"
                    label-for="storeys"
                  >
                    <b-form-input
                      id="storeys"
                      type="number"
                      min="0"
                      size="sm"
                      v-model="form.storeys"
                    ></b-form-input>
                  </b-form-group>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <b-form-group
                        description="Enter min price"
                        label="Price(min)"
                        label-for="min_price"
                      >
                        <b-form-input
                          id="min_price"
                          type="number"
                          min="0"
                          size="sm"
                          v-model="form.min_price"
                        ></b-form-input>
                      </b-form-group>
                    </div>
                    <div class="col-md-6">
                      <b-form-group
                        description="Enter max price"
                        label="Price(max)"
                        label-for="max_price"
                      >
                        <b-form-input
                          id="max_price"
                          type="number"
                          min="0"
                          size="sm"
                          v-model="form.max_price"
                        ></b-form-input>
                      </b-form-group>
                    </div>
                  </div>

                  <b-form-group
                    description="Enter bathrooms count"
                    label="Bathrooms"
                    label-for="bathrooms"
                  >
                    <b-form-input
                      id="bathrooms"
                      type="number"
                      min="0"
                      size="sm"
                      v-model="form.bathrooms"
                    ></b-form-input>
                  </b-form-group>

                  <b-form-group
                    description="Enter garages count"
                    label="Garages"
                    label-for="garages"
                  >
                    <b-form-input
                      id="garages"
                      type="number"
                      min="0"
                      size="sm"
                      v-model="form.garages"
                    ></b-form-input>
                  </b-form-group>
                </div>
              </div>
              <b-button type="submit" @click="onSubmit" variant="primary"
                >Submit</b-button
              >
              <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-12" v-if="rows > 0">
            <h2 class="text-center">Search result</h2>
            <b-table
              id="data-table"
              :items="items"
              :per-page="perPage"
              :current-page="currentPage"
              small
              striped
              bordered
            ></b-table>
            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
              aria-controls="data-table"
              align="right"
            ></b-pagination>
          </div>
          <div class="col-md-12 text-center" v-if="rows == 0">
            <h2>Search return empty result</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
import Loading from "vue-loading-overlay";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  name: "Main",
  components: {
    Loading
  },
  props: {
    msg: String
  },
  data() {
    return {
      form: {
        name: null,
        max_price: null,
        min_price: null,
        bedrooms: null,
        bathrooms: null,
        storeys: null,
        garages: null
      },
      info: null,
      items: null,
      perPage: 10,
      currentPage: 1,
      rows: null,
      isLoading: false,
      fullPage: true
    };
  },
  methods: {
    onSubmit() {
      const axios = require("axios");
      this.isLoading = true;
      axios
        .post("http://lumen/", {
          name: this.form.name,
          max_price: this.form.max_price,
          min_price: this.form.min_price,
          bedrooms: this.form.bedrooms,
          bathrooms: this.form.bathrooms,
          storeys: this.form.storeys,
          garages: this.form.garages
        })
        .then(
          response => (
            (this.info = response.data),
            (this.items = response.data),
            (this.rows = response.data.length),
            (this.isLoading = false)
          )
        )
        .catch(function(error) {
          this.isLoading = false;
          alert(error);
        });
    }
  },
  computed: {},
  mounted() {}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss"></style>
