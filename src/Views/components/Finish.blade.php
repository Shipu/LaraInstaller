<template id="finish">
    <fieldset>
        <div class="finished">
            Congratulation, Completed Installation Process !!!
        </div>
        <button @click="nextorprevious('database')" class="previous action-button"> Previous </button>
        <button @click="nextorprevious('finish')" class="next action-button"> Finished </button>
    </fieldset>
</template>