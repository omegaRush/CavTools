<?php

class CavTools_DataWriter_EnlistmentLogs extends XenForo_DataWriter {

    /**
     * Gets the fields that are defined for the table. See parent for explanation.
     *
     * @return array
     */
    protected function _getFields()
    {
        return array(
            'xf_ct_rrd_logs' => array(
                'log_id' => array('type' => self::TYPE_UINT, 'autoIncrement' => true),
                'enlistment_id' => array('type' => self::TYPE_INT),
                'user_id' => array('type' => self::TYPE_INT),
                'username' => array('type' => self::TYPE_STRING),
                'log_date' => array('type' => self::TYPE_FLOAT),
                'action_taken' => array('type' => self::TYPE_STRING),
            )
        );
    }

    /**
     * Gets the actual existing data out of data that was passed in. See parent for explanation.
     *
     * @param mixed
     *
     * @see XenForo_DataWriter::_getExistingData()
     *
     * @return array|false
     */
    protected function _getExistingData($data)
    {
        if (!$id = $this->_getExistingPrimaryKey($data, 'log_id'))
        {
            return false;
        }

        return array('xf_ct_rrd_logs' => $this->_getEnlistmentLogModel()->getLogById($id));
    }

    /**
     * Gets SQL condition to update the existing record.
     *
     * @see XenForo_DataWriter::_getUpdateCondition()
     *
     * @return string
     */
    protected function _getUpdateCondition($tableName)
    {
        return 'log_id = ' . $this->_db->quote($this->getExisting('log_id'));
    }

    /**
     * Get the enlistment model.
     *
     * @return CavTools_Model_Enlistment
     */
    protected function _getEnlistmentLogModel()
    {
        return $this->getModelFromCache ( 'CavTools_Model_EnlistmentLog' );
    }
}