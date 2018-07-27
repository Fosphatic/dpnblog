<div class="uk-margin uk-flex uk-flex-space-between uk-flex-wrap" data-uk-margin>
    <div data-uk-margin>

        <h2 class="uk-margin-remove">{{ 'Social' | trans }}</h2>

    </div>
    <div data-uk-margin>

        <button class="uk-button uk-button-primary" @click.prevent="save">{{ 'Save' | trans }}</button>

    </div>
</div>

<div class="uk-form-row">
    <span class="uk-form-label">{{ 'Active' | trans }}</span>
    <div class="uk-form-controls uk-form-controls-text">
        <p class="uk-form-controls-condensed">
            <label><input type="checkbox" v-model="config.share.active"> {{ 'Social Button Active' | trans }}</label>
        </p>
    </div>
</div>

<div class="uk-form-row">
    <span class="uk-form-label">{{ 'Like Active' | trans }}</span>
    <div class="uk-form-controls uk-form-controls-text">
        <p class="uk-form-controls-condensed">
            <label><input type="checkbox" v-model="config.like"> {{ 'Like posts and comments' | trans }}</label>
        </p>
    </div>
</div>
