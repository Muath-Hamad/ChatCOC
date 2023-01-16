#!/usr/bin/env python
# coding: utf-8

import os
import sys
os.path.dirname(sys.executable)

# to transfer arabic number to english
import pyarabic.trans
import pandas as pd
import numpy as np
import tabula


# # convert PDF into CSV file
tabula.convert_into("../data/class.pdf", "../data/output.csv", output_format="csv", pages='all')




# pd.set_option('display.max_rows', None)


# # dealing with the nulls



df = pd.read_csv('../data/output.csv')





df.dropna(subset=['القاعة'] , inplace=True) # if القاعة is null then delete all row





df[df['الوقت'].isna()] #if the الوقت is null then it is the above calss but it has diffrent time




# one probelm we face is that the location of columns is diffrent then the original data frame this loop will change the values
for index, row in df.iterrows():
    if(row['الوقت'] != row['الوقت']):
        df['المسجلين'][index] = row['المحاضر']
        df['الوقت'][index] = row['المستفيد']
        tem = row['جاهزة']
        df['اعلى حد'][index]= row['القاعة']
        df['القاعة'][index] = tem
        # df['اعلى حد'][index] = row['جاهزة']
        # df['القاعة']
        df['المحاضر'][index] = None
        df['المستفيد'][index] = None
        df['جاهزة'][index] = None


df = df.drop(['اسم المقرر'] , axis=1)

df.isna().sum()

df[df['المستوى'].isna()   ][df['المحاضر'].isna() == False] # these that has not been assign any time


for index, row in df.iterrows():
    if(row['المستوى'] != row['المستوى']): # null
        if (row['الوقت'] == 'لم يحدد من الكلية'): #not null
            df['Unnamed: 16'][index] = row['Unnamed: 14']
            df['الشعب'][index] = row['Unnamed: 14']
            df['Unnamed: 14'][index] = row['المقرر']
            df['المقرر'][index] = row['س']
            df['س'][index] = row['النشاط']
            df['المستوى'][index] = row['التسلسل']
            df['المسجلين'][index] = 'لم يحدد من الكلية'
            df['اعلى حد'][index] = 'لم يحدد من الكلية'
            # print(0)



df[df['المستوى'].isna()   ][df['المحاضر'].isna() == False] # these that has not been assign any time

df.isna().sum()


df[df['اعلى حد'].isna()] # no meaning


df.dropna(subset=['اعلى حد'] , inplace=True)


df.isna().sum()


df['index'] = df.index


df[df['النشاط'].isna()]


# for index, row in df.iterrows():
#     if index in list1 :
#         df['Unnamed: 16'][index] = row['Unnamed: 14']
#         df['الشعب'][index] = row['المقرر']
#         df['Unnamed: 14'][index] = row['اسم المقرر']
#         df['المقرر'][index]  = row['س']
#         df['اسم المقرر'][index] = row['المستوى']
#         df['س'][index]= row['النشاط']
#         df['المستوى'][index] = row['التسلسل']
#         df['النشاط'][index] = row['اعلى حد']
#         df['التسلسل'][index] = row['المسجلين']
#         df['اعلى حد'][index] = 'لم يحدد من الكلية	'
#         df['المسجلين'][index] = 'لم يحدد من الكلية'


df = df.fillna(method='ffill') # fill all values by above


df.isna().sum()

df[df['القاعة'].isna()]


# ## rename columns
df.head(1)


df = df.rename(columns={"Unnamed: 16": "الشعبة", "الشعب": "المقرر", "Unnamed: 14": "اسم المقرر", "المقرر": "ساعات المقرر", "س": "النشاط", "النشاط": "اعلى حد", "التسلسل": "المسجلين", "اعلى حد": "الايام", "المسجلين": "من" , "الوقت": "الى"} )


# df = df.drop(columns=['index'])


df = df.rename(columns={df.columns[10]:"التسلسل" ,df.columns[11] : 'النشاط'} )

df = df.rename(columns={df.columns[0]:"فتره"} )


df = df[df['الايام']!= 'اعلى حد']

df[df['index'] == 59]


df['الايام'].value_counts()


for ind , row in df.iterrows() : # change to eng
    for i in df.columns :
        try:
            df[i][ind] = pyarabic.trans.normalize_digits(row[i])
        except:
            pass


df['الى'].value_counts()


df['المقرر'].value_counts()



for index, row in df.iterrows():
    if(row['المقرر'] == row['الشعبة']): # null
        # if (row['الوقت'] == 'لم يحدد من الكلية'): #not null
            # print(row)
            df['المقرر'][index] = row['اسم المقرر']
            # print(0)



import re
for index, row in df.iterrows():
    # print(i)
    if re.search(r"\s", row['المقرر']):
    # print(i)
        i = re.sub(r"\s", "", row['المقرر'])
        df['المقرر'][index] = i



df['المقرر'].unique()




df[df['المقرر'] == 'CS451']['الشعبة']




# df.to_csv('../data/class.csv' , index=False)
#

