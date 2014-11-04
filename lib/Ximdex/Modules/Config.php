<?php

namespace Ximdex\Modules ;



class Config {

    // Object composition.
    var $defMngr;

    /**
     *  @public
     */
    function ModulesConfig() {

        $this->defMngr = new DefManager(XIMDEX_ROOT_PATH.MODULES_INSTALL_PARAMS);

        $this->defMngr->setPrefix(PRE_DEFINE_MODULE);
        $this->defMngr->setPostfix(POST_DEFINE_MODULE);
    }


    /**
     *  @public
     */
    function enableModule($name) {
        $this->defMngr->enableItem(strtoupper($name));
    }

    /**
     *  @public
     */
    function disableModule($name) {

        $this->defMngr->disableItem(strtoupper($name));
    }

}