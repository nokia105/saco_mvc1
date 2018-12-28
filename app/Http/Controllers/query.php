UPDATE `loans` SET loanInssue_date =2018-11-30 WHERE loanInssue_date=2018-11-08

update `loans` set loanInssue_date=date_format(loanInssue_date,'%Y-11-22') WHERE loanInssue_date=date_format(loanInssue_date,'%Y-11-30')

update `loanschedules` set duedate=date_format(duedate,'%Y-02-28') WHERE duedate=date_format(duedate,'%Y-03-02')  need to update bank account and other account

  case of date yyyy-03-01


  //delete query
  DELETE `repayments`,`loanschedules`,`loans` FROM `repayments` INNER JOIN loanschedules ON `repayments`.`loanschedule_id`=`loanschedules`.`id` INNER JOIN `loans` ON `loanschedules`.loan_id=`loans`.`id` WHERE `loans`.id=8

  //delete query in bank account 

  SELECT * FROM `bankaccounts` where memberaccount_id=81 AND date BETWEEN '2018-12-14' AND '2019-09-14'



         //member takes his savings and shares
         -----view should have place to minus taken savings and shares coming from special account of a parrticular member
         ------cr bank account dr bank account
        
        ------------------------

        delete qury should involve members,memberaccount innerjoin

        update `bankaccounts` set date=date_format(date,'%Y-02-28') WHERE date=date_format(date,'%Y-03-02')

        update `repayments` set paymentdate=date_format(paymentdate,'%Y-02-28') WHERE paymentdate=date_format(paymentdate,'%Y-03-01')

        update `loanaccounts` set date=date_format(date,'%Y-02-28') WHERE date=date_format(date,'%Y-03-02')

        update `receivableaccounts` set date=date_format(date,'%Y-02-28') WHERE date=date_format(date,'%Y-03-01')

            //update member_share table
            update `member_share` set state='in' WHERE state=''

               

               //savings shares delete

               DELETE `member_share`,`payments`,`bankaccounts` FROM `payments` INNER JOIN `member_share` ON `payments`.`member_share_id`=`member_share`.`id` INNER JOIN `bankaccounts` ON `bankaccounts`.`payment_id`=`payments`.`id` WHERE `member_share`.`member_id`=;

               DELETE `membersavings`,`payments`,`bankaccounts` FROM `payments` INNER JOIN `membersavings` ON `payments`.`membersaving_id`=`membersavings`.`id` INNER JOIN `bankaccounts` ON `bankaccounts`.`payment_id`=`payments`.`id` WHERE `membersavings`.`member_id`=;

               DELETE from `membersavings` where `membersavings`.`member_id`=;

