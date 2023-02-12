<div class="card">
    <div class="card-header">
      جدول السنة الأكاديمية
    </div>
    <div class="card-body">
     <form method="post" action="{{ route('adminpage.update') }}" class="mt-6 space-y-6" >
        @csrf


      <div class="form-group">
        <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">تأجيل الفصل :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_1" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_1" class="form-control">
          </div>
        </div>

        <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">بدايه الفصل  :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_2" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2"> الاعتذار :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_3" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">الانسحاب من المقرر:</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_4" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_4" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2"> تغيير التخصص للترم القادم :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_5" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_5" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">تغيير المقر للترم القادم:</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_6" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_6" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">  الاختبارات النهائيه:</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_7" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_7" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2"> إجازة نهاية السنة :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_8" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_8" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">التحويل من جامعة القصيم :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_9" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_9" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">اخر موعد لرصد الدرجات :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_10" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">حساب المعدل :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_11" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">توزيع الوثائق :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_12" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2"> بدايه فصل جديد :</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_13" class="form-control">
          </div>


          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2">  الاجازات المطوله 1 : </label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_14" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_14" class="form-control">
          </div>

          <div class="form-row">
            <div class="col-auto align-self-center">
                <label class="ml-2"> الاجازات المطوله 2:</label>
              </div>
          <div class="col-sm-5">
            <label for="start-date">تاريخ البداية :</label>
            <input type="date" name="start_date_15" class="form-control">
          </div>
          <div class="col-sm-5">
            <label for="end-date">تاريخ النهاية :</label>
            <input type="date" name="end_date_15" class="form-control">
          </div>

      </div>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

