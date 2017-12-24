<?php

class Attendance {

    public static function getGracePeriod($payrollpolicycode) {
        $graceperiod = ConfigPayrollPolicies::model()->findByAttributes(array('con_pp_code' => $payrollpolicycode));
        return $graceperiod;
    }

    public static function getTimeDifference($time1, $time2) {
        $timeone = strtotime($time1);
        $timetwo = strtotime($time2);

        $timediff = 0;
        if ($timeone > $timetwo) {
            $timediff = $timeone - $timetwo;
            return $timediff;
        } else {
            $timediff = $timetwo - $timeone;
            return $timediff;
        }
    }

    public static function dailyAttendance($empno, $punch, $location, $punchBy) {
        $model = new DailyAttendance();
        $isavailabledailyattendance = NULL;
        $punch_in = '';
        $punch_out = '';
        $shifthalf = '';

        $timezone = Controller::getTimeZone();
        $punchdate = gmdate('Y-m-d', strtotime($punch) + $timezone);
        $employeedata = Empbasic::model()->findByAttributes(array('attendance_no' => $empno));

        $isavailabledailyattendance = $model->findByAttributes(array('ref_emp_id' => $employeedata->emp_id, 'day' => $punchdate)); //there will be a condition of date_out also.

        if (count($employeedata) == 0) {
            return;
        }
        $shift = $model->getEmpWorkshift($employeedata->emp_id, $punchdate);

        $shiftstarttime = $shift[0];
        $shiftendtime = $shift[1];
        $isnightshift = $shift[2];
        $shiftInUpTo = $shift[17];
        $shiftOutUpTo = $shift[18];

        $shifthalf = gmdate('H:i:s', (strtotime($shiftstarttime) + (strtotime($shiftendtime) - strtotime($shiftstarttime)) / 2) + $timezone);
        $previousshiftdate = gmdate('Y-m-d', strtotime($punchdate) - (24 * 60 * 60) + $timezone);
        $previousdayshift = $model->getEmpWorkshift($employeedata->emp_id, $previousshiftdate);
        $prevDayAttendance = $model->findByAttributes(array('ref_emp_id' => $employeedata->emp_id, 'day' => $previousshiftdate)); //there will be a condition of date_out also.

        $previousshiftstarttime = $previousdayshift[0];
        $previousshiftendtime = $previousdayshift[1];
        $previousisnightshift = $previousdayshift[2];
        $previousShiftInUpTo = $previousdayshift[17];
        $previousShiftOutUpTo = $previousdayshift[18];

// Day Shift
        if ($isnightshift == 0 && $isnightshift != '') {
            Attendance::actionDayShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
        }

//Night Shift
        elseif ($isnightshift == 1 && $isnightshift != '') {
            Attendance::actionNightShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
        }

//Off Day
        if ($isnightshift == '') {//this is for not assigned shift
            if ($previousisnightshift == 1 && (strtotime($punch) > strtotime($previousShiftInUpTo) && strtotime($punch) <= strtotime($previousShiftOutUpTo))) {
                Attendance::actionNightShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
            } else {
                $previousShiftInUpTo = $previousdayshift[17];
                $previousShiftOutUpTo = $previousdayshift[18];
                if (date('H:i:s', strtotime($previousShiftInUpTo)) != "00:00:00" && strtotime($previousShiftInUpTo) < strtotime($punch) && strtotime($previousShiftOutUpTo) >= strtotime($punch)) {
                    if (date('H:i:s', strtotime($shiftInUpTo)) != "00:00:00") {
                        if ($isnightshift == 0) {
                            Attendance::actionDayShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                        } elseif ($isnightshift == 1) {
                            Attendance::actionNightShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                        }
                    } else {
                        if ($prevDayAttendance->punch_out == "00:00:00") {
                            if ($previousisnightshift == 0) {
                                Attendance::actionDayShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                            } elseif ($previousisnightshift == 1) {
                                Attendance::actionNightShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                            }
                        } else {
                            Attendance::actionNoShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                        }
                    }
                } else {
                    Attendance::actionNoShift($employeedata->emp_id, $punch, $punchdate, $timezone, $location, $punchBy);
                }
            }
        }
    }

    public static function actionDayShift($empid, $punch, $punchdate, $timezone, $location, $punchBy, $shift = NULL) {
        $model = new Dailyattendance;
        $timezone = Controller::getTimeZone();
        if ($shift == NULL) {
            $shift = $model->getEmpWorkshift($empid, $punchdate);
        }


        if (strtotime($punch) >= strtotime($shift[17]) && strtotime($punch) < strtotime($shift[18])) {
            $punchdate = gmdate('Y-m-d', strtotime($punch) + $timezone);
        } else {
            $punchdate = gmdate('Y-m-d', strtotime($punch . ' - 1 days') + $timezone);
        }

        $isavailabledailyattendance = $model->findByAttributes(array('ref_emp_id' => $empid, 'day' => $punchdate)); //there will be a condition of date_out also.           
        $shiftstarttime = $shift[0];
        $shiftendtime = $shift[1];
        $isnightshift = $shift[2];
        $shiftin_till = $shift[7];
        $shiftId = $shift[8];
        $shiftInUpto = $shift[17];
        $shiftOutUpto = $shift[18];

        $previousshiftdate = gmdate('Y-m-d', strtotime($punchdate) - (24 * 60 * 60) + $timezone);
        $previousdayshift = $model->getEmpWorkshift($empid, $previousshiftdate);
        $prevShiftInUpto = $previousdayshift[17];
        $prevShiftOutUpto = $previousdayshift[18];
        $prevShiftInTill = $previousdayshift[7];

        $prevDayAttendance = $model->findByAttributes(array('ref_emp_id' => $empid, 'day' => $previousshiftdate)); //there will be a condition of date_out also.   

        $shifthalf = gmdate('Y-m-d H:i:s', (strtotime($shiftstarttime) + (strtotime($shiftendtime) - strtotime($shiftstarttime)) / 2) + $timezone);
        $shiftin_till = gmdate('H:i:s', strtotime($shiftin_till) + $timezone) == '00:00:00' ? $shifthalf : gmdate('Y-m-d H:i:s', strtotime($shiftin_till) + $timezone);
        $day = gmdate('Y-m-d', strtotime($shiftstarttime) + $timezone);

        if (strtotime($shiftInUpto) < strtotime($punch) && strtotime($shiftOutUpto) >= strtotime($punch)) {
            if (count($isavailabledailyattendance) == 0) {
                $punchindate = '0000-00-00';
                $punchintime = '00:00:00';
                $punchoutdate = '0000-00-00';
                $punchouttime = '00:00:00';

                if ($shiftin_till > date('Y-m-d H:i:s', strtotime($punch))) {
                    $punchindate = gmdate('Y-m-d', strtotime($punch) + $timezone);
                    $punchintime = gmdate('H:i:s', strtotime($punch) + $timezone);
                    $inOrOut = 1;
                } else {
                    $punchoutdate = gmdate('Y-m-d', strtotime($punch) + $timezone);
                    $punchouttime = gmdate('H:i:s', strtotime($punch) + $timezone);
                    $inOrOut = 2;
                }

                Attendance::actionInsertDailyAttendance($empid, $day, $punchindate, $punchintime, $punchoutdate, $punchouttime, '', '', '', '', $shiftId, $location, $punchBy, $inOrOut);
            } else {
                if ($shiftin_till > date('Y-m-d H:i:s', strtotime($punch))) {//thawa punch in ekak natnam kiyalath check karanna-done                                                  
                    if (strtotime($shiftInUpto) < strtotime($prevShiftOutUpto) && count($prevDayAttendance) > 0 && $prevDayAttendance->punch_out == "00:00:00" && $isavailabledailyattendance->punch_in != "00:00:00") {
                        Attendance::actionUpdateDailyAttendance($empid, '', '', $isavailabledailyattendance->date_in, $isavailabledailyattendance->punch_in, '', '', '', '', $prevDayAttendance, $location, $punchBy, 2);
                        $isavailabledailyattendance->date_in = '0000-00-00';
                        $isavailabledailyattendance->punch_in = '00:00:00';
                        $isavailabledailyattendance->save(false);
                        Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                    } else {
                        if ($isavailabledailyattendance['punch_in'] == '00:00:00' || $isavailabledailyattendance['punch_in'] > '00:00:00' || $isavailabledailyattendance['punch_in'] > gmdate('H:i:s', strtotime($punch) + $timezone)) {
                            if ($isavailabledailyattendance['punch_out'] == "00:00:00" && $isavailabledailyattendance['punch_in'] < gmdate('H:i:s', strtotime($punch) + $timezone)) {
                                Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                            } else {
                                Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                            }
                        } elseif ($isavailabledailyattendance['punch_in'] > '00:00:00' && $isavailabledailyattendance['punch_out'] < gmdate('H:i:s', strtotime($punch) + $timezone)) {
                            Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                        }
                    }
                } else {
                    if ($isavailabledailyattendance['punch_in'] > '00:00:00' && $isavailabledailyattendance['punch_out'] == '00:00:00' || $isavailabledailyattendance['punch_in'] > '00:00:00' && $isavailabledailyattendance['date_out'] . ' ' . $isavailabledailyattendance['punch_out'] < gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                        $isavailabledailyattendance->punch_out_location = NULL;
                        $isavailabledailyattendance->punch_out_status = NULL;
                        $isavailabledailyattendance->save(false);
                        Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                    } elseif ($isavailabledailyattendance['punch_in'] == '00:00:00' && $isavailabledailyattendance['punch_out'] > '00:00:00' && $isavailabledailyattendance['date_out'] . ' ' . $isavailabledailyattendance['punch_out'] < gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                        $isavailabledailyattendance->date_in = $isavailabledailyattendance['date_out'];
                        $isavailabledailyattendance->punch_in = $isavailabledailyattendance['punch_out'];
                        $isavailabledailyattendance->punch_in_location = $isavailabledailyattendance['punch_out_location'];
                        $isavailabledailyattendance->punch_in_status = $isavailabledailyattendance['punch_out_status'];
                        $isavailabledailyattendance->punch_out_location = NULL;
                        $isavailabledailyattendance->punch_out_status = NULL;
                        $isavailabledailyattendance->save(false);
                        Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                    }
                }
            }
        } else {
            $isPrevDayAttendanceAvailable = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punch) - (24 * 60 * 60) + $timezone)))));
            if (count($isPrevDayAttendanceAvailable) > 0) {
                Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
            } else {
                if (strtotime($prevShiftInTill) < strtotime($punch)) {
                    Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) - (24 * 60 * 60) + $timezone), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                } else {
                    Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) - (24 * 60 * 60) + $timezone), gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $shiftId, $location, $punchBy, 1);
                }
            }
        }
    }

    public static function actionNightShift($empid, $punch, $punchdate, $timezone, $location, $punchBy) {
        $model = new Dailyattendance;
        $isavailabledailyattendance = NULL;
        $punchdate = gmdate('Y-m-d', strtotime($punch) + $timezone);
        $shift = $model->getEmpWorkshift($empid, $punchdate);
        $shiftstarttime = $shift[0];
        $shiftendtime = $shift[1];
        $isnightshift = $shift[2];
        $issplitshift = $shift[3];
        $shiftin_till = $shift[7];
        $shiftInUpto = $shift[17];
        $shiftOutUpto = $shift[18];
        $shiftId = $shift[8];

        $shiftendtime = gmdate('Y-m-d H:i:s', strtotime($shiftendtime) + (24 * 60 * 60) + $timezone);
        $previousshiftdate = gmdate('Y-m-d', strtotime($punchdate) - (24 * 60 * 60) + $timezone);
        $previousdayshift = $model->getEmpWorkshift($empid, $previousshiftdate);
        $prevDayAttendance = $model->findByAttributes(array('ref_emp_id' => $empid, 'day' => $previousshiftdate)); //there will be a condition of date_out also.   

        $previousshiftstarttime = $previousdayshift[0];
        $previousshiftendtime = $previousdayshift[1];
        $previousisnightshift = $previousdayshift[2];

        $previousshiftendtime = $previousisnightshift == 1 ? gmdate('Y-m-d H:i:s', strtotime($previousshiftendtime) + (24 * 60 * 60) + $timezone) : gmdate('Y-m-d H:i:s', strtotime($previousshiftendtime) + $timezone);
        $shiftgapfrompreviousshift = Attendance::getTimeDifference($shiftstarttime, $previousshiftendtime);
        $previousshiftendtimewithgap = gmdate('Y-m-d H:i:s', strtotime($previousshiftendtime) + ($shiftgapfrompreviousshift / 2) + $timezone);
        $prevShiftInUpto = $previousdayshift[17];
        $prevShiftOutUpto = $previousdayshift[18];
        $prevShiftInTill = $previousdayshift[7];

        $isavailabledailyattendance = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
            'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punchdate) + $timezone)))));

        if (strtotime($shiftInUpto) < strtotime($punch) && strtotime($shiftOutUpto) >= strtotime($punch)) {
            if (count($isavailabledailyattendance) == 0) {
                if (strtotime($punch) > strtotime($previousshiftendtimewithgap)) {
                    if (strtotime($punch) < strtotime($shiftin_till)) {
                        Attendance::actionInsertDailyAttendance($empid, date('Y-m-d', strtotime($shiftstarttime)), gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $shiftId, $location, $punchBy, 1);
                    } elseif (strtotime($punch) > strtotime($shiftin_till) && date('Y-m-d', strtotime($punch)) == date('Y-m-d', strtotime($shiftstarttime))) {
                        Attendance::actionInsertDailyAttendance($empid, date('Y-m-d', strtotime($shiftstarttime)), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                    }
                } else {
                    $availableattendance = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                        'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punchdate) - (24 * 60 * 60) + $timezone)))));
                    if (count($availableattendance) == 0) {
                        Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', (strtotime($punch) - (24 * 60 * 60) + $timezone)), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                    } else {
                        Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $availableattendance, $location, $punchBy, 2);
                    }
                }
            } else {

                if (strtotime($punch) > strtotime($previousshiftendtimewithgap)) {
                    if (strtotime($shiftInUpto) < strtotime($prevShiftOutUpto) && count($prevDayAttendance) > 0 && $prevDayAttendance->punch_out == "00:00:00" && $isavailabledailyattendance->punch_in != "00:00:00") {
                        if (strtotime($punch) > strtotime($shiftstarttime)) {
                            if (strtotime($isavailabledailyattendance->date_in . ' ' . $isavailabledailyattendance->punch_in) != 0 && strtotime($isavailabledailyattendance->date_in . ' ' . $isavailabledailyattendance->punch_in) < strtotime($punch) && (strtotime($punch) - strtotime($isavailabledailyattendance->date_in . ' ' . $isavailabledailyattendance->punch_in)) > 900) {
                                Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $isavailabledailyattendance->punch_in_location, $isavailabledailyattendance->punch_in_status, 2);
                            } else {
                                Attendance::actionUpdateDailyAttendance($empid, '', '', $isavailabledailyattendance->date_in, $isavailabledailyattendance->punch_in, '', '', '', '', $prevDayAttendance, $location, $punchBy, 2);
                                $isavailabledailyattendance->date_in = '0000-00-00';
                                $isavailabledailyattendance->punch_in = '00:00:00';
                                $isavailabledailyattendance->save(false);
                                Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                            }
                        } else {
                            Attendance::actionUpdateDailyAttendance($empid, '', '', $isavailabledailyattendance->date_in, $isavailabledailyattendance->punch_in, '', '', '', '', $prevDayAttendance, $isavailabledailyattendance->punch_in_location, $isavailabledailyattendance->punch_in_status, 2);
                            $isavailabledailyattendance->date_in = '0000-00-00';
                            $isavailabledailyattendance->punch_in = '00:00:00';
                            $isavailabledailyattendance->save(false);
                            Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                        }
                    } else {
                        if (strtotime($punch) < strtotime($shiftin_till) && $isavailabledailyattendance['date'] . ' ' . $isavailabledailyattendance['punch_in'] > gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                            Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                        } else {
                            if ($isavailabledailyattendance['punch_out'] != '00:00:00' && $isavailabledailyattendance['punch_in'] == '00:00:00' && $isavailabledailyattendance['date_out'] . ' ' . $isavailabledailyattendance['punch_out'] < gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                                $isavailabledailyattendance->date_in = $isavailabledailyattendance['date_out'];
                                $isavailabledailyattendance->punch_in = $isavailabledailyattendance['punch_out'];
                                $isavailabledailyattendance->punch_in_status = $isavailabledailyattendance['punch_out_status'];
                                $isavailabledailyattendance->punch_in_location = $isavailabledailyattendance['punch_out_location'];
                                $isavailabledailyattendance->punch_out_status = NULL;
                                $isavailabledailyattendance->punch_out_location = NULL;
                                $isavailabledailyattendance->save(false);
                                Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                            } elseif ($isavailabledailyattendance['punch_in'] != '00:00:00' && $isavailabledailyattendance['date_out'] . ' ' . $isavailabledailyattendance['punch_out'] < gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                                $isavailabledailyattendance->punch_out_status = NULL;
                                $isavailabledailyattendance->punch_out_location = NULL;
                                $isavailabledailyattendance->save(false);
                                Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 2);
                            }
                        }
                    }
                } else {
                    $availableattendance = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                        'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punchdate) - (24 * 60 * 60) + $timezone)))));

                    if (count($availableattendance) > 0) {
                        if ($availableattendance['date_out'] . ' ' . $availableattendance['punch_out'] < gmdate('Y-m-d H:i:s', strtotime($punch) + $timezone)) {
                            Attendance::actionUpdateDailyAttendance($empid, '', '', $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $availableattendance, $location, $punchBy, 2);
                        } else {
                            Attendance::actionUpdateDailyAttendance($empid, $punchdate, gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isavailabledailyattendance, $location, $punchBy, 1);
                        }
                    } else {
                        Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', (strtotime($punch) + $timezone)), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                    }
                }
            }
        } else {
            $isPrevDayAttendanceAvailable = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punch) - (24 * 60 * 60) + $timezone)))));

            $isAttendanceAvailable = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punch) + $timezone)))));

            if (date('H:i:s', strtotime($shiftInUpto)) != "00:00:00") {
                if (strtotime($shiftInUpto) > strtotime($punch)) {
                    if (strtotime($prevShiftInUpto) < strtotime($punch) && strtotime($prevShiftOutUpto) >= strtotime($punch)) {
                        if (count($isPrevDayAttendanceAvailable) > 0) {
                            Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
                        } else {
                            Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', (strtotime($punch) - (24 * 60 * 60)) + $timezone), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                        }
                    } else {
                        if (date('H:i:s', strtotime($prevShiftOutUpto)) != "00:00:00" && date('H:i:s', strtotime($shiftInUpto)) != "00:00:00") {
                            $rangeGapThreeQuater = ((strtotime($shiftInUpto) - strtotime($prevShiftOutUpto)) / 4) * 3; //                         
                            if ((strtotime($prevShiftOutUpto) + $rangeGapThreeQuater) > strtotime($punch)) {
                                if (count($isPrevDayAttendanceAvailable) > 0) {
                                    Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
                                } else {
                                    Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) + $timezone), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                                }
                            } else {
                                if (count($isAttendanceAvailable) > 0) {
                                    Attendance::actionUpdateDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $isAttendanceAvailable, $location, $punchBy, 1);
                                } else {
                                    Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $shiftId, $location, $punchBy, 1);
                                }
                            }
                        } else {
                            if ($isPrevDayAttendanceAvailable->punch_out == "00:00:00") {
                                Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
                            } else {
                                Attendance::actionNoShift($empid, $punch, $punchdate, $timezone, $location, $punchBy);
                            }
                        }
                    }
                } elseif (strtotime($shiftOutUpto) < strtotime($punch)) {//this goes with not available shift to particular day
                    $isPrevDayAttendanceAvailable = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                        'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punch) + $timezone)))));
                    if (count($isPrevDayAttendanceAvailable) > 0) {
                        Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
                    } else {
                        Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', strtotime($punch) + $timezone), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                    }
                }
            } else {
                $isPrevDayAttendanceAvailable = $model->find(array('condition' => 'ref_emp_id=:empid AND day = :date',
                    'params' => array(':empid' => $empid, ':date' => gmdate('Y-m-d', (strtotime($punch) - (24 * 60 * 60) + $timezone)))));

                if (count($isPrevDayAttendanceAvailable) > 0) {
                    if (strtotime($punch) < strtotime($previousdayshift[7])) {
                        Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', (strtotime($punch) - (24 * 3600)) + $timezone), gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', '', '', $shiftId, $location, $punchBy, 1);
                    } else {
                        Attendance::actionUpdateDailyAttendance($empid, '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $isPrevDayAttendanceAvailable, $location, $punchBy, 2);
                    }
                } else {
                    Attendance::actionInsertDailyAttendance($empid, gmdate('Y-m-d', (strtotime($punch) - (24 * 3600)) + $timezone), '', '', gmdate('Y-m-d', strtotime($punch) + $timezone), gmdate('H:i:s', strtotime($punch) + $timezone), '', '', '', '', $shiftId, $location, $punchBy, 2);
                }
            }
        }
    }

    private static function actionInsertDailyAttendance($empid, $day, $indateone, $intimeone, $outdateone, $outtimeone, $indatetwo, $intimetwo, $outdatetwo, $outtimetwo, $shiftId, $location, $punchBy, $inOrOut) {
        $model = new Dailyattendance;
        $model->ref_emp_id = $empid;
        $model->day = $day;
        $model->date_in = ($indateone == '0000-00-00' || $indateone == '') ? "0000-00-00" : $indateone;
        $model->punch_in = ($intimeone == '00:00:00' || $intimeone == '') ? '00:00:00' : $intimeone;
        $model->date_out = ($outdateone == '0000-00-00' || $outdateone == '') ? "0000-00-00" : $outdateone;
        $model->punch_out = ($outtimeone == '00:00:00' || $outtimeone == '') ? '00:00:00' : $outtimeone;
        $model->ref_shift_id = $shiftId;
        $model->punch_in_location = ($inOrOut == 1 && ($model->punch_in_location == '' || $model->punch_in_location == NULL)) ? $location : $model->punch_in_location;
        $model->punch_out_location = ($inOrOut == 2 && ($model->punch_out_location == '' || $model->punch_out_location == NULL)) ? $location : $model->punch_out_location;
        $model->punch_in_status = ($inOrOut == 1 && ($model->punch_in_status == 0 || $model->punch_in_status == NULL)) ? $punchBy : $model->punch_in_status;
        $model->punch_out_status = ($inOrOut == 2 && ($model->punch_out_status == 0 || $model->punch_out_status == NULL)) ? $punchBy : $model->punch_out_status;
        $model->update_at = date("Y-m-d H:i:s");
        if ($model->save(false)) {
        }
    }

    public static function actionUpdateDailyAttendance($empid, $indateone, $intimeone, $outdateone, $outtimeone, $indatetwo, $intimetwo, $outdatetwo, $outtimetwo, $isavailabledailyattendance, $location, $punchBy, $inOrOut) {
        $isavailabledailyattendance->ref_emp_id = $empid;
        $isavailabledailyattendance->date_in = ($indateone == '') ? $isavailabledailyattendance->date_in : ($indateone < $isavailabledailyattendance->date_in || $isavailabledailyattendance->date_in == '0000-00-00' ? $indateone : $isavailabledailyattendance->date_in);
        $isavailabledailyattendance->punch_in = ($intimeone == '') ? $isavailabledailyattendance->punch_in : ($intimeone < $isavailabledailyattendance->punch_in || $isavailabledailyattendance->punch_in == '00:00:00' ? $intimeone : $isavailabledailyattendance->punch_in);
        $isavailabledailyattendance->date_out = ($outdateone != '') ? $outdateone : $isavailabledailyattendance->date_out;
        $isavailabledailyattendance->punch_out = ($outtimeone != '') ? $outtimeone : $isavailabledailyattendance->punch_out;
        $isavailabledailyattendance->punch_in_location = ($inOrOut == 1 && ($isavailabledailyattendance->punch_in_location == '' || $isavailabledailyattendance->punch_in_location == NULL)) ? $location : $isavailabledailyattendance->punch_in_location;
        $isavailabledailyattendance->punch_out_location = ($inOrOut == 2 && ($isavailabledailyattendance->punch_out_location == '' || $isavailabledailyattendance->punch_out_location == NULL)) ? $location : $isavailabledailyattendance->punch_out_location;
        $isavailabledailyattendance->punch_in_status = ($inOrOut == 1 && ($isavailabledailyattendance->punch_in_status == 0 || $isavailabledailyattendance->punch_in_status == NULL)) ? $punchBy : $isavailabledailyattendance->punch_in_status;
        $isavailabledailyattendance->punch_out_status = ($inOrOut == 2 && ($isavailabledailyattendance->punch_out_status == 0 || $isavailabledailyattendance->punch_out_status == NULL)) ? $punchBy : $isavailabledailyattendance->punch_out_status;
        $isavailabledailyattendance->update_at = date("Y-m-d H:i:s");
        if ($isavailabledailyattendance->update(false)) {
            $dailyAttId = $isavailabledailyattendance->atten_id;
            $isavailabledailyattendance->early_time = Attendance::getOTIn($dailyAttId);
            $isavailabledailyattendance->late_time = Attendance::getLateIn($dailyAttId);
            $isavailabledailyattendance->early_living = Attendance::getEarlyOut($dailyAttId);
            $isavailabledailyattendance->over_time = Attendance::getOTOut($dailyAttId);
            $isavailabledailyattendance->save(false);
        }
    }

    public static function getOTIn($dailyAttId) {
        $DailyAttendance = new Dailyattendance;
        $otindata = Attendance::getGracePeriod('OI');
        $otinrounddata = Attendance::getGracePeriod('OIR');

        $isavailabledailyattendance = Dailyattendance::model()->findByPk($dailyAttId);
        $empid = $isavailabledailyattendance->ref_emp_id;
        $date = $isavailabledailyattendance->day;

        $otingrace = $otindata->con_pp_grace_period;
        $otinispay = $otindata->con_pp_ispay;
        $otinroundgrace = $otinrounddata->con_pp_grace_period;

        $empshift = $DailyAttendance->getEmpWorkshift($empid, $date);
        $shiftstarttime = $empshift[0];
        $shiftendtime = $empshift[1];
        $empin = $isavailabledailyattendance->date_in . " " . $isavailabledailyattendance->punch_in;
        $empout = $isavailabledailyattendance->date_out . " " . $isavailabledailyattendance->punch_out;

        $OTIn = 0;
        if (count($empshift) > 0) {//checking available shift
            if (count($isavailabledailyattendance) > 0) {//checking details on daily attendance
                if ($empin != '0000-00-00 00:00:00') {
                    if (strtotime($shiftstarttime) > strtotime($empin)) {
                        $totalInOverTime = Attendance::getTimeDifference($shiftstarttime, $empin);
                    } else {
                        $totalInOverTime = 0;
                    }

                    if ($totalInOverTime >= ($otingrace * 60) && $otinispay == 0 && $otinroundgrace == 0) {//concept 01 and concept 02 // logic-grace eka tibbath gewanne naa grace ekata
                        $OTIn = gmdate('H:i:s', $totalInOverTime - ($otingrace * 60));
                        return $OTIn;
                    } elseif ($totalInOverTime >= ($otingrace * 60) && $otinispay == 1 && $otinroundgrace == 0) {//concept 03// logic-grace eka tibbath gewanawa
                        $OTIn = gmdate('H:i:s', $totalInOverTime);
                        return $OTIn;
                    } elseif ($totalInOverTime >= ($otingrace * 60) && $otinispay == 0 && $otinroundgrace > 0) {//has to develope
                        $totalInOverTime = $totalInOverTime - ($otingrace * 60);
                        $otinroundrest = $totalInOverTime % ($otinroundgrace * 60);
                        $otinwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $otinroundrest), gmdate('H:i:s', $totalInOverTime));
                        $OTIn = gmdate('H:i:s', $otinwithoutroundrest);
                        return $OTIn;
                    } elseif ($totalInOverTime >= ($otingrace * 60) && $otinispay == 1 && $otinroundgrace > 0) {//has to develope
                        $otinroundrest = $totalInOverTime % ($otinroundgrace * 60);
                        $otinwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $otinroundrest), gmdate('H:i:s', $totalInOverTime));
                        $OTIn = gmdate('H:i:s', $otinwithoutroundrest);
                        return $OTIn;
                    }
                }
                return $OTIn;
            }
            return $OTIn;
        }
        return $OTIn;
    }

    public static function getLateIn($dailyAttId) {
        $DailyAttendance = new Dailyattendance;
        $Indata = Attendance::getGracePeriod('IT');
        $lateRoundData = Attendance::getGracePeriod('LTR');

        $Ingrace = $Indata->con_pp_grace_period;
        $Inispay = $Indata->con_pp_ispay;
        $lateInRound = $lateRoundData->con_pp_grace_period;

        $isavailabledailyattendance = Dailyattendance::model()->findByPk($dailyAttId);
        $empid = $isavailabledailyattendance->ref_emp_id;
        $date = $isavailabledailyattendance->day;

//        $avaiableHalfDayLeaves = Yii::app()->db->createCommand('SELECT * FROM hr_leaveapplication hl LEFT JOIN hr_leaveapplication_dates hld ON hl.leave_id=hld.dates_leave_id WHERE hl.ref_emp_id=' . $empid . ' AND hld.dates_leave_date="' . $date . '";')->queryAll();

        $empshift = $DailyAttendance->getEmpWorkshift($empid, $date);
        $shiftstarttime = $empshift[0];
        $shiftendtime = $empshift[1];

//        if (count($avaiableHalfDayLeaves) > 0) {
//            if ($avaiableHalfDayLeaves->dates_leave_count == 0.5) {
//                if ($avaiableHalfDayLeaves->dates_time_period == 1) {
//                    $shiftstarttime = date('Y-m-d H:i:s', strtotime($empshift[0]) + $empshift[13]);
//                } elseif ($avaiableHalfDayLeaves->dates_time_period = 2) {
//                    $shiftendtime = date('Y-m-d H:i:s', strtotime($empshift[0]) + $empshift[13]);
//                }
//            }
//        }

        $empin = $isavailabledailyattendance->date_in . " " . $isavailabledailyattendance->punch_in;
        $empout = $isavailabledailyattendance->date_out . " " . $isavailabledailyattendance->punch_out;

        $LateIn = 0;
        if (count($empshift) > 0) {//checking available shift
            if (count($isavailabledailyattendance) > 0) {//checking details on daily attendance
                if ($empin != '0000-00-00 00:00:00') {
                    if (strtotime($shiftstarttime) < strtotime($empin)) {
                        $TotalLateIn = Attendance::getTimeDifference($empin, $shiftstarttime);
                    } else {
                        $TotalLateIn = 0;
                    }
                    if ($TotalLateIn > ($Ingrace * 60) && $Inispay == 1 && $lateInRound == 0) {//late kapanne natnam.a kiyanne late kapanne naa kiyanne gewanawa kiyana ekane.
                        $LateIn = gmdate('H:i:s', $TotalLateIn + $timezone);
                        return $LateIn;
                    } elseif ($TotalLateIn > ($Ingrace * 60) && $Inispay == 0 && $lateInRound == 0) {
                        $LateIn = gmdate('H:i:s', $TotalLateIn - ($Ingrace * 60));
                        return $LateIn;
                    } elseif ($TotalLateIn > ($Ingrace * 60) && $Inispay == 1 && $lateInRound > 0) {
                        $laterest = $TotalLateIn % ($lateInRound * 60);
                        $latewithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $laterest), gmdate('H:i:s', $TotalLateIn));
                        $LateIn = gmdate('H:i:s', $latewithoutroundrest + $timezone);
                        return $LateIn;
                    } elseif ($TotalLateIn > ($Ingrace * 60) && $Inispay == 0 && $lateInRound > 0) {
                        $TotalLateIn = $TotalLateIn - ($Ingrace * 60);
                        $laterest = $TotalLateIn % ($lateInRound * 60);
                        $latewithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $laterest), gmdate('H:i:s', $TotalLateIn));
                        $LateIn = gmdate('H:i:s', $latewithoutroundrest + $timezone);
                        return $LateIn;
                    }
                }
            }
        }
        return $LateIn;
    }

    public static function getEarlyOut($dailyAttId) {
        $DailyAttendance = new Dailyattendance;
        $Outdata = Attendance::getGracePeriod('LT');
        $EarlyOutData = Attendance::getGracePeriod('EOR');

        $Outgrace = $Outdata->con_pp_grace_period;
        $Outispay = $Outdata->con_pp_ispay;
        $EarlyOutRound = $EarlyOutData->con_pp_grace_period;

        $isavailabledailyattendance = Dailyattendance::model()->findByPk($dailyAttId);
        $empid = $isavailabledailyattendance->ref_emp_id;
        $date = $isavailabledailyattendance->day;
        $empshift = $DailyAttendance->getEmpWorkshift($empid, $date);

        $shiftstarttime = $empshift[0];
        $shiftendtime = $empshift[1];
        $isnightshift = $empshift[2];
        $issplitshift = $empshift[3];

//        $avaiableHalfDayLeaves = Yii::app()->db->createCommand('SELECT * FROM hr_leaveapplication hl LEFT JOIN hr_leaveapplication_dates hld ON hl.leave_id=hld.dates_leave_id WHERE hl.ref_emp_id=' . $empid . ' AND hld.dates_leave_date="' . $date . '";')->queryAll();
//        if (count($avaiableHalfDayLeaves) > 0) {
//            if ($avaiableHalfDayLeaves->dates_leave_count == 0.5) {
//                if ($avaiableHalfDayLeaves->dates_time_period == 1) {
//                    $shiftstarttime = date('Y-m-d H:i:s', strtotime($empshift[0]) + $empshift[13]);
//                } elseif ($avaiableHalfDayLeaves->dates_time_period = 2) {
//                    $shiftendtime = date('Y-m-d H:i:s', strtotime($empshift[0]) + $empshift[13]);
//                }
//            }
//        }

        if ($isnightshift == 1) {
            $shiftendtime = date('Y-m-d H:i:s', (strtotime($shiftendtime) + (24 * 60 * 60)));
        }

        if (strtotime($shiftendtime) != strtotime($empshift[20])) {
            $shiftendtime = $empshift[20];
        } else {
            $shiftendtime = $shiftendtime;
        }

        $empin = $isavailabledailyattendance->date_in . " " . $isavailabledailyattendance->punch_in;
        $empout = $isavailabledailyattendance->date_out . " " . $isavailabledailyattendance->punch_out;

//        if (count($avaiableHalfDayLeaves) > 0) {
//            if ($avaiableHalfDayLeaves->dates_leave_count == 1) {
//                $EarlyOut = "00:00:00";
//                return $EarlyOut;
//            }
//        }

        $EarlyOut = 0;
        if (count($empshift) > 0) {//checking available shift
            if (count($isavailabledailyattendance) > 0) {//checking details on daily attendance
//        if($empin != '0000-00-00 00:00:00' and $empout != '0000-00-00 00:00:00'){
                if ($empout != '0000-00-00 00:00:00') {
                    if (strtotime($shiftendtime) > strtotime($empout)) {
                        $TotalEarlyOut = Attendance::getTimeDifference($empout, $shiftendtime);
                    } else {
                        $TotalEarlyOut = 0;
                    }
                    if ($TotalEarlyOut > ($Outgrace * 60) && $Outispay == 1 && $EarlyOutRound == 0) {//early out kapanne natnam.a kiyanne early out kapanne naa kiyanne gewanawa kiyana ekane.
                        $EarlyOut = gmdate('H:i:s', $TotalEarlyOut);
                        return $EarlyOut;
                    } elseif ($TotalEarlyOut > ($Outgrace * 60) && $Outispay == 0 && $EarlyOutRound == 0) {
                        $EarlyOut = gmdate('H:i:s', ($TotalEarlyOut - ($Outgrace * 60)));
                        return $EarlyOut;
                    } elseif ($TotalEarlyOut > ($Outgrace * 60) && $Outispay == 1 && $EarlyOutRound > 0) {
                        $earlyoutrest = $TotalEarlyOut % ($EarlyOutRound * 60);
                        $earlyoutwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $earlyoutrest), gmdate('H:i:s', $TotalEarlyOut));
                        $EarlyOut = gmdate('H:i:s', $earlyoutwithoutroundrest + $timezone);
                        return $EarlyOut;
                    } elseif ($TotalEarlyOut > ($Outgrace * 60) && $Outispay == 0 && $EarlyOutRound > 0) {
                        $TotalEarlyOut = $TotalEarlyOut - ($Outgrace * 60);
                        $earlyoutrest = $TotalEarlyOut % ($EarlyOutRound * 60);
                        $earlyoutwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $earlyoutrest), gmdate('H:i:s', $TotalEarlyOut));
                        $EarlyOut = gmdate('H:i:s', $earlyoutwithoutroundrest + $timezone);
                        return $EarlyOut;
                    }
                }
            }
        }

//        if (count($avaiableHalfDayLeaves) > 0) {
//            if ($avaiableHalfDayLeaves->dates_leave_count == 0.5) {
//                $EarlyOut = "00:00:00";
//                return $EarlyOut;
//            }
//        }
        return $EarlyOut;
    }

    public static function getOTOut($dailyAttId) {
        $DailyAttendance = new Dailyattendance;
//        $holiday = new ConfigHolidays;
        $otoutdata = Attendance::getGracePeriod('OL');
        $otoutrounddata = Attendance::getGracePeriod('OLR');

        $otoutgrace = $otoutdata->con_pp_grace_period;
        $otoutispay = $otoutdata->con_pp_ispay;
        $otoutroundgrace = $otoutrounddata->con_pp_grace_period;

        $isavailabledailyattendance = Dailyattendance::model()->findByPk($dailyAttId);
        $empid = $isavailabledailyattendance->ref_emp_id;
        $date = $isavailabledailyattendance->day;
        $empshift = $DailyAttendance->getEmpWorkshift($empid, $date);

        $shiftstarttime = $empshift[0];
        $shiftendtime = $empshift[1];
        $isnightshift = $empshift[2];
        $issplitshift = $empshift[3];

        if ($isnightshift == 1) {
            $shiftendtime = date('Y-m-d H:i:s', (strtotime($shiftendtime) + (24 * 60 * 60)));
        }

        $empin = $isavailabledailyattendance->date_in . " " . $isavailabledailyattendance->punch_in;
        $empout = $isavailabledailyattendance->date_out . " " . $isavailabledailyattendance->punch_out;

        $OTOut = 0;
        if (count($empshift) > 0) {//checking available shift
            if (count($isavailabledailyattendance) > 0) {//checking details on daily attendance
//        if($empin != '0000-00-00 00:00:00' and $empout != '0000-00-00 00:00:00'){
                if ($empout != '0000-00-00 00:00:00') {
                    if (strtotime($shiftendtime) < strtotime($empout)) {
                        if (strtotime($shiftendtime) < strtotime($empin)) {
                            $totalOutOverTime = Attendance::getTimeDifference($empin, $empout);
                        } else {
                            $totalOutOverTime = Attendance::getTimeDifference($shiftendtime, $empout);
                        }
                    } else {
                        $totalOutOverTime = 0;
                    }
                    if ($totalOutOverTime >= ($otoutgrace * 60) && $otoutispay == 0 && $otoutroundgrace == 0) {//concept 01 and concept 02 // logic-grace eka tibbath gewanne naa grace ekata
                        $OTOut = gmdate('H:i:s', $totalOutOverTime - ($otoutgrace * 60));
                        return $OTOut;
                    } elseif ($totalOutOverTime >= ($otoutgrace * 60) && $otoutispay == 1 && $otoutroundgrace == 0) {//concept 03// logic-grace eka tibbath gewanawa
                        $OTOut = gmdate('H:i:s', $totalOutOverTime);
                        return $OTOut;
                    } elseif ($totalOutOverTime >= ($otoutgrace * 60) && $otoutispay == 0 && $otoutroundgrace > 0) {//has to develope
                        $totalOutOverTime = $totalOutOverTime - ($otoutgrace * 60);
                        $otoutroundrest = $totalOutOverTime % ($otoutroundgrace * 60);
                        $otoutwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $otoutroundrest), gmdate('H:i:s', $totalOutOverTime));
                        $OTOut = gmdate('H:i:s', $otoutwithoutroundrest);
                        return $OTOut;
                    } elseif ($totalOutOverTime >= ($otoutgrace * 60) && $otoutispay == 1 && $otoutroundgrace > 0) {//has to develope
                        $otoutroundrest = $totalOutOverTime % ($otoutroundgrace * 60);
                        $otoutwithoutroundrest = Attendance::getTimeDifference(gmdate('H:i:s', $otoutroundrest), gmdate('H:i:s', $totalOutOverTime));
                        $OTOut = gmdate('H:i:s', $otoutwithoutroundrest);
                        return $OTOut;
                    }
                }
                return $OTOut;
            }
            return $OTOut;
        }
        return $OTOut;
    }

}
