<template id="finish">
    <fieldset>
        <div class="finished">
            Congratulation, Completed Installation Process !!!
        </div>
        <button @click="nextorprevious('permission')" class="previous action-button"> Previous </button>
        <button @click="nextorprevious('finish')" class="next action-button"> Finished </button>
    </fieldset>
</template>