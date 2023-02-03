#!/usr/bin/env python
# coding: utf-8
import pyarabic.trans
import pandas as pd
import numpy as np
import tabula

df = pd.read_csv('.\app\python\data\class.csv')

li = list(df['المقرر'].unique())

classST = pd.DataFrame(columns=['ماده','متطلب'])

# Append each value in the list as a new row in the DataFrame
for value in li:
    classST = classST.append({'ماده': value , "متطلب" :float('nan') }, ignore_index=True)

classST['متطلب'].isna().sum()

for i in range(classST.shape[0]):
    if 'CS182' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS181'

    if 'MATH116' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH115'

    if 'COE23' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'COE121'

    if 'CS211' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS181'

    if 'CS213' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS182'

    if 'IC102' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'IC101'

    if 'MATH212' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH116'

    if 'CS214' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH212'

    if 'CS221' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'COE223'

    if 'CS222' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS182'

    if 'CS224' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS213'

    if 'IC103' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'IC101'

    if 'CS315' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS211'

    if 'CS341' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS182'

    if 'CS342' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS182'

    if 'MATH317' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH116'

    if 'MATH329' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH116'

    if 'COE351' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS222'

    if 'COE352' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS222'

    if 'CS348' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH329'
    if 'CS383' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS222'

    if 'MATH314' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH212'

    if 'CS423' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS224'

    if 'CS451' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS315'

    if 'CS498' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = '120 ساعه'

    if 'CS432' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'MATH329'

    if 'CS471' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS342'

    if 'CS499' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'CS498'

    if 'IC104' == str(classST.loc[i,'ماده']):
        classST.loc[i,'متطلب'] = 'IC101'


classST['متطلب'].isna().sum()

classST.to_csv('../data/clPLAN.csv' , index=False)

