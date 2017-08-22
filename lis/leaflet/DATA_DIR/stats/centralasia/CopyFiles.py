import os
import shutil
params = ['FAR','MEAN','PODY','RMSE']
for i in range(1, 19):
    for param in params:
        shutil.copy(param+'_ASC_Basin'+str(i)+'_SnowCover_v_SnowCover.txt', 'monthly/'+str(i)+'/'+param + '.txt')
