#!/usr/bin/env python
# coding: utf-8

# In[1]:


import os
import sys
os.path.dirname(sys.executable)


# In[2]:


# to transfer arabic number to english 
import pyarabic.trans


# In[3]:


import pandas as pd
import numpy as np
import tabula


# In[4]:




# # convert PDF into CSV file
tabula.convert_into("../data/class.pdf", "../data/output.csv", output_format="csv", pages='all')


# In[5]:


# pd.set_option('display.max_rows', None)


# # dealing with the nulls 

# In[6]:


df = pd.read_csv('../data/output.csv')


# In[7]:


df


# In[8]:


df.dropna(subset=['القاعة'] , inplace=True) # if القاعة is null then delete all row 


# In[9]:


df


# In[10]:


df[df['الوقت'].isna()] #if the الوقت is null then it is the above calss but it has diffrent time 


# In[11]:


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
    


# In[12]:


df


# In[13]:


df = df.drop(['اسم المقرر'] , axis=1)


# In[14]:


df.isna().sum()


# In[15]:


df[df['المستوى'].isna()   ][df['المحاضر'].isna() == False] # these that has not been assign any time 


# In[16]:


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
            
            


# In[17]:


df[df['المستوى'].isna()   ][df['المحاضر'].isna() == False] # these that has not been assign any time 


# In[18]:


df.isna().sum()


# In[19]:


df[df['اعلى حد'].isna()] # no meaning 


# In[20]:


df.dropna(subset=['اعلى حد'] , inplace=True)


# In[21]:


df.isna().sum()


# In[22]:


df['index'] = df.index


# In[23]:


df[df['النشاط'].isna()]


# In[24]:


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
        


# In[25]:


df = df.fillna(method='ffill') # fill all values by above


# In[26]:


df.isna().sum()


# In[27]:


df[df['القاعة'].isna()]


# ## rename columns

# In[28]:


df.head(1)


# In[29]:


df = df.rename(columns={"Unnamed: 16": "الشعبة", "الشعب": "المقرر", "Unnamed: 14": "اسم المقرر", "المقرر": "ساعات المقرر", "س": "النشاط", "النشاط": "اعلى حد", "التسلسل": "المسجلين", "اعلى حد": "الايام", "المسجلين": "من" , "الوقت": "الى"} )


# In[30]:


# df = df.drop(columns=['index'])


# In[31]:


df = df.rename(columns={df.columns[10]:"التسلسل" ,df.columns[11] : 'النشاط'} )


# In[32]:


df = df.rename(columns={df.columns[0]:"فتره"} )


# In[33]:


df


# In[34]:


df = df[df['الايام']!= 'اعلى حد']


# In[35]:


df[df['index'] == 59]


# In[36]:


df['الايام'].value_counts()


# In[37]:


for ind , row in df.iterrows() : # change to eng
    for i in df.columns :
        try:
            df[i][ind] = pyarabic.trans.normalize_digits(row[i])
        except:
            pass


# In[38]:


df['الى'].value_counts()


# In[39]:


df['المقرر'].value_counts()


# In[40]:


for index, row in df.iterrows():
    if(row['المقرر'] == row['الشعبة']): # null 
        # if (row['الوقت'] == 'لم يحدد من الكلية'): #not null 
            # print(row)
            df['المقرر'][index] = row['اسم المقرر']
            # print(0)
            


# In[41]:


import re
for index, row in df.iterrows():
    # print(i)
    if re.search(r"\s", row['المقرر']):
    # print(i)
        i = re.sub(r"\s", "", row['المقرر'])
        df['المقرر'][index] = i 


# In[ ]:





# In[42]:


df['المقرر'].unique()


# In[43]:


df


# In[44]:


df[df['المقرر'] == 'CS451']['الشعبة']


# In[45]:


# df.to_csv('../data/class.csv' , index=False)
# 

