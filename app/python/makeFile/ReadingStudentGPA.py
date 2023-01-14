#!/usr/bin/env python
# coding: utf-8

# In[14]:


import os
import sys
os.path.dirname(sys.executable)


# In[15]:


# to transfer arabic number to english 
import pyarabic.trans


# In[16]:


import pandas as pd
import numpy as np
import tabula


# In[17]:




# # convert PDF into CSV file
tabula.convert_into("../data/StudentGPA.pdf", "../data/StudentGPA.csv", output_format="csv", pages='all')


# In[ ]:





# In[18]:


# with open("../data/StudentGPA", "r+" , encoding="utf8") as f:
#     d = f.readlines()
#     f.seek(0)
#     for i in d:
#         if i != '"'[0]:
#             print(i[1])
#             # f.write(i)
#     # f.truncate()


# In[19]:


df = pd.read_csv('../data/StudentGPA.csv',  on_bad_lines='skip')


# In[20]:


# '\"\",,,,,,' == "",,,,,,


# # i don't know why it is not reading the Primary Year 

# In[21]:


df


# In[22]:


df = df[df['رمز المقرر'] !='رمز المقرر' ]


# In[23]:


df["الساعات"] = df["الساعات"].astype(int)


# ## thus it give me that i only have 118 hours 

# In[24]:


df["الساعات"].sum()


# In[25]:


for ind , row in df.iterrows() :
    for i in df.columns :
        try:
            df[i][ind] = pyarabic.trans.normalize_digits(row[i])
        except:
            pass


# In[26]:


df.to_csv('../data/StudentGPA.csv' , index=False)

